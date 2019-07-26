<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	function __construct(){
	
		parent::__construct();
		$this->load->model("kantor_m");
		
	}

	
	function index(){
		
		$data['include_script'] = inc_script(
		
			array(
				"includes/datatables/jquery.dataTables.min.js",				
				"cms/plugin/kantor/js/info.js",
			)
		); 				
		
		$data['title']	= "Data Kantor";
		
		$_usr 	= $this->kantor_m->__select('mdl_user_data', '*', array('usr_id'=>get_session("user_id")), false);
		
		$_w 	= array(
					"company_id"=>@if_empty($_usr->company, ''),
					"jabatan_id"=>@if_empty($_usr->jabatan, '')
				);
		
		//$data['kantor'] = $this->kantor_m->getkantorByIdper();
		$data['breadcrumb_active'] = $data['title'];
				
		$data['str_category']= json_decode(Modules::run("api/options", "bb_opt_category_informasi"), true);
			
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
				
		$this->masterpage->addContentPage('user_form', 'contentmain', $data);
		
		$this->masterpage->show( );
	}

	function list($id)
	{
		$data['include_script'] = inc_script(
		
			array(
			
				"includes/datatables/jquery.dataTables.min.js",
				
				"cms/plugin/kantor/js/info.js",
			)
		);
		$data['title']	= "Pusat Informasi Kantor";
		
		$_usr 	= $this->kantor_m->__select('mdl_user_data', '*', array('usr_id'=>get_session("user_id")), false);
		
		$_w 	= array(
					"company_id"=>@if_empty($_usr->company, ''),
					"jabatan_id"=>@if_empty($_usr->jabatan, '')
				);
		
		//$data['kantor'] = $this->kantor_m->get_list_kantor($_w);
		$data['kantor'] = $this->kantor_m->getkantorByIdper($id);
		$data['breadcrumb_active'] = $data['title'];
		
		$data['str_category']= json_decode(Modules::run("api/options", "bb_opt_category_informasi"), true);
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_form', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	
}
