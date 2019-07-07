<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * plugin untuk mengirim pesan pertanyaan yang akan di jawab oleh admin
 */ 
class Qa extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("qa_m");		
	}
	
	/**
	 * hanya form pertanyaan dan kirim ke admin
	 */ 
	
	function index(){
		
		$data["title"] = "Kirim Pertanyaan";
		
		$data['breadcrumb_active'] = $data['title'];
	
		$data['include_script'] = inc_script(
		
			array(
		
				"cms/plugin/qa/js/user.js",
			)
		);			
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_form_qa', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function save(){
		
		$_p['subjek'] 	= $this->input->post("subjek");
		
		$_p['ask'] 	= $this->input->post("ask");
		
		$_p['usr_id']	= get_session("user_id");
		
		$_ = $this->qa_m->__insert('mdl_qa_ask', $_p);
		
		redirect(base_url()."qa?success=".$_);
	}
	
	/*
	 * menampilkan list pertanyaan yg pernah user tersebut ajukan
	 */
	
	function history(){
		
		$data['status'] = isset($_GET['status']) ? $this->input->get('status') : false;
		
		$data['include_script'] = inc_script(
			
			array(				
				"includes/jquery.validate/jquery.validate.min.js",
				
				"cms/plugin/qa/js/user.js",
			)
		);
		
		$data["title"]	= "Formulir Keluhan";
		
		$data["qa"] = $this->qa_m->get_qa(null,null, get_session('user_id'));
		
		$this->load->helper("dashboard/dashboard");
		
		$this->masterpage->addContentPage('user_qa_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($qa_id){
		
		$data['include_script'] = inc_script(
			
			array(
			
				"includes/jquery.validate/jquery.validate.min.js",
				
				"cms/plugin/qa/js/user.js",
			)
		);
		
		$data["qa"] 	= $this->qa_m->get_qa($qa_id);
		
		$data["qa_id"]	= $qa_id;
		
		$data["title"]	= $data["qa"]->subjek;
		
		$data["ans"]	= $this->qa_m->get_answer_by_qa($qa_id);
		
		$this->load->helper("dashboard/dashboard");
		
		$this->masterpage->addContentPage('user_qa_view', 'contentmain', $data);

		$this->masterpage->show( );		
	}
	
	function save_ask(){
		
		$data["category"] = $this->input->post("category");
		
		$data["subjek"] = $this->input->post("subjek");
		
		$data["ask"] 	= $this->input->post("pertanyaan");
		
		$data["status"] = "open";
		
		$data["usr_id"]	= get_session('user_id');
		
		$_notif["qa_id"]= $this->qa_m->save_qa($data);
		
		$_notif["msg"]	= "mengajukan pertanyaan";
				
		$this->set_notif_to_admin($_notif);
		
		redirect(base_url()."qa/view/".$_notif["qa_id"]);
	}
	
	function save_answer(){
		
		$data["qa_id"]	= $this->input->post("qa_id");
		
		$data["answer"] 	= $this->input->post("answer");
		
		$data["usr_id"]	= get_session('user_id');
		
		$this->qa_m->save_qa_log($data);
		
		$_notif["qa_id"]= $data["qa_id"];
		
		$_notif["msg"]	= "mereply pertanyaan";
				
		$this->set_notif_to_admin($_notif);
		
		//redirect(base_url()."qa/view/".$_notif["qa_id"]);
		redirect(base_url()."qa?status=success");
	}
	
	function set_notif_to_admin($var){
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$user = $this->bluehrd_user_m->get_user(get_session('user_id'));

		$_notif["title"] 	= $user->nama_lengkap . " " . $var["msg"];

		$_notif["url"]		= base_url()."qa/admin/reply/".$var["qa_id"];

		Modules::run("notification/set", $_notif);
	}
/*
	function index(){

		$data["title"] = "Slip Gaji";

		$data['include_script'] = inc_script(
			array(				
				"cms/plugin/attendance/css/calender.css",
			)
		);

		$data["year"] 	= @if_empty(getVar("year")) ? getVar("year") : date("Y");

		$data["month"] 	= @if_empty(getVar("month")) ? getVar("month") : date("n");
		
		$data["usr_id"] = get_session('user_id');
		
		$this->load->model("cuti/cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($data["usr_id"]);

		$data["max_year"] = date("Y") + 1;
		
		$this->load->helper("attendance/attendance");

		$data["att"]	= att_to_array($this->att_m->get_attendance($data["usr_id"], $data["year"], $data["month"]));
	
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
/**/
}
