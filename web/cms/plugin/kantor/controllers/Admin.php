<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("info_m");
	}

	// base_url()."cuti/admin/index/".?year=2018&month=7
	function index(){
		
		$data = array('selected_company'=>'', 'selected_jabatan'=>'');
		
		// include third library
		$data['include_script'] = inc_script(
			
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/informasi/js/admin.js",
			)
		);
		 
		$_w = array();
		
		if(isset($_GET['company_id']) && $_GET['company_id'] != '') {
		
			$_w['company_id'] = $this->input->get('company_id');
			
			$data['selected_company'] = $_w['company_id'];
		}
		
		if(isset($_GET['jabatan_id']) && $_GET['jabatan_id'] != '') {
			
			$_w['jabatan_id'] = $this->input->get('jabatan_id');
			
			$data['selected_jabatan'] = $_w['jabatan_id'];
		}
		
		if(isset($_GET['category_id']) && $_GET['category_id'] != '') {
			
			$_w['category'] = $this->input->get('category_id');
			
			$data['selected_category'] = $_w['category'];
		}
		
		debug($_w, '_w');
		
		$data['str_company']= Modules::run("api/options", "bb_opt_company");
		
		$data['slc_company']= json_decode($data['str_company'], true);
		
		$data['str_jabatan']= Modules::run("api/options", "bb_opt_jabatan");
		
		$data['slc_jabatan']= json_decode($data['str_jabatan'], true);
		
		$data['str_category']= Modules::run("api/options", "bb_opt_category_informasi");
		
		$data['slc_category']= json_decode($data['str_category'], true);
		
		$data['tables'] = $this->info_m->get_list_info($_w);
		
		//debug($data['tables']);
		
		$data['title']	= 'Employee Information Center' ;
		
		$this->masterpage->addContentPage('admin_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function form($info_id=null){
		
		if($info_id) { 
			
			$_w = array("i.info_id"=>$info_id);
			
			$data['info'] = $this->info_m->get_single_info($_w);
			
			$data['role'] = $this->info_m->__select("mdl_info_role i", "*", $_w);			
		} 
		
		else $data['role'] = (object) array(); // create dumy object, removed error 'role variable not found'
		
		$data['slc_category']= Modules::run("api/options", "bb_opt_category_informasi");
		
		$data['slc_company']= Modules::run("api/options", "bb_opt_company");
		
		$data['slc_jabatan']= Modules::run("api/options", "bb_opt_jabatan");
		
		echo $this->load->view("admin_form", $data, true);
	}
	
	function save(){
		
		$_w["info_id"] = (int) $this->input->post("info_id");
		
		$_p['title'] 		= $this->input->post('title');
		
		$_r['company_ids'] 	= $this->input->post('company_id');
		
		$_r['jabatan_ids'] 	= $this->input->post('jabatan_id');
		
		$_p['description'] 	= $this->input->post('description');
		
		$_p['category'] 	= $this->input->post('category');
		
		$config['upload_path']          = './uploads/info/';
        
        $config['allowed_types']        = 'pdf|docx|doc|xls|xlsx';
		
		$this->load->library('upload', $config);
		
		if (  $this->upload->do_upload('file')){
			
			$_ud = $this->upload->data();
			
			$_p['file'] = $_ud['file_name'];
		} 
		
		//else dump($this->upload->display_errors());
		//*
		if(!$_w["info_id"]) $_w["info_id"] = $this->info_m->__insert("mdl_info", $_p);
		
		else $this->info_m->__update("mdl_info", $_p, $_w);
		
		// role set
		$this->info_m->__delete("mdl_info_role", array("info_id"=>$_w["info_id"]));
		
		foreach($_r['company_ids'] as $_rc){
			
			foreach($_r['jabatan_ids'] as $_rj){
				
				$this->info_m->__insert("mdl_info_role", array("info_id"=>$_w["info_id"], "company_id"=>$_rc, "jabatan_id"=>$_rj));
			}
		}
		
		/**/
		//if($_w["info_id"] > 0) echo "insert query";
		
		//else echo "update query";
		/*
		dump($_POST, "POST");
		dump($_w["info_id"] > 0, 'logic info_id');
		dump($_w, '_w');
		dump($_p, '_p');		
		dump($this->info_m->__last_query(), 'query');
		/**/
		redirect(base_url()."admin/informasi");
	}
	
	function delete($info_id = null){
		
		if($info_id){
			
			$this->info_m->__delete("mdl_info", array("info_id"=>$info_id));
		}
		
		redirect(base_url()."admin/informasi");
	}
}
