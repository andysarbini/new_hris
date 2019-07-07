<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("qa_m");
	}
	
	// list pertanyaan
	function index(){
		
		$_w["year(tgl)"] = @if_empty($this->input->get("year"), date("Y"));
		
		$data["title"] 	= "Pertanyaan " . $_w["year(tgl)"];
		
		$data["data"]		= $this->qa_m->get_qa_ask($_w);
		
		$data['include_script'] = inc_script(

			array(

				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",

				"cms/plugin/qa/js/admin.js",
			)
		);
	
		$this->load->helper('cuti/cuti');
		
		$this->masterpage->addContentPage('admin_qa_ask', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function delete( $ask_id ){
		
		$this->qa_m->__delete("mdl_qa_ask", array("ask_id"=>$ask_id));
	}
	
	function mail( $ask_id ) {
		
		$_v = $this->qa_m->get_qa_ask(array("ask_id"=>$ask_id));
		
		$_ = $_v[0];
		
		$_subjek = $_->nama_lengkap ."(".$_->nip.") ".$_->subjek;
		
		$_msg = $_->ask;
		
		$_user = 'xxx@gmail.com';
		
		$_pass = 'xxx@gmail.com';
		
		$config = Array(
		
			'protocol' => 'smtp',
		
			'smtp_host' => 'ssl://smtp.googlemail.com',
		
			'smtp_port' => 465,
		
			'smtp_user' => $_user, // change it to yours
		
			'smtp_pass' => $_pass, // change it to yours
		
			'mailtype' => 'html',
		
			'charset' => 'iso-8859-1',
		
			'wordwrap' => TRUE
		);
		
		$this->load->library('email', $config);
		
		$this->email->set_newline("\r\n");
		
		$this->email->from($_user); // change it to yours
		
		$this->email->to($_user);// change it to yours
		
		$this->email->subject($_subjek);
		
		$this->email->message($_v->ask);
		
		if($this->email->send()) $this->qa_m->__update("mdl_qa_ask", array("status"=>1), array("ask_id"=>$ask_id));
		
		else show_error($this->email->print_debugger());
	}

	function history($status = "open"){
		
		$data["title"] = "Pertanyaan";
		
		$data["qa"] = $this->qa_m->get_qa(null,$status);
		
		
		$data['include_script'] = inc_script(
		
			array(
		
				"cms/plugin/qa/js/admin.js",
			)
		);
	
		$this->load->helper("dashboard/dashboard");
		
		$this->masterpage->addContentPage('admin_qa_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($qa_id = null){
		
		$data["qa"] 	= $this->qa_m->get_qa($qa_id);
		
		$data["qa_id"]	= $qa_id;
		
		$data["title"]	= $data["qa"]->subjek;
		
		$data["ans"]	= $this->qa_m->get_answer_by_qa($qa_id);
		
		$this->load->helper("dashboard/dashboard");
		
		$this->masterpage->addContentPage('admin_qa_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function reply_answer(){
		
		$answer = $this->input->post("answer");
		
		$status = $this->input->post("status");
		
		$qa_id	= $this->input->post("qa_id");
		
		$this->qa_m->__update("mdl_qa", array("status"=>$status), array("qa_id"=>$qa_id));
		
		$_qa_log = array("qa_id"=>$qa_id, "answer"=>$answer);
		
		$this->qa_m->__insert("mdl_qa_log", $_qa_log);
		
		redirect(base_url()."qa/admin/view/".$qa_id);
	}
}
