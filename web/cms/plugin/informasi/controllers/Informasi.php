<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends GW_User {
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model("info_m");
		
		$this->usr_id = get_session("user_id");
		
		$this->breadcrumb = array();
	}
	
	function index(){

		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
				
				"cms/plugin/informasi/js/info.js",
			)
		);

		
		$data['title']	= "Pusat Informasi Karyawan";
		
		$_usr 	= $this->info_m->__select('mdl_user_data', '*', array('usr_id'=>get_session("user_id")), false);
		
		$_w 	= array(
					"company_id"=>@if_empty($_usr->company, ''),
					"jabatan_id"=>@if_empty($_usr->jabatan, '')
				);
		
		$data['tables'] = $this->info_m->get_list_info($_w);
		
		$data['breadcrumb_active'] = $data['title'];
		
		$data['str_category']= json_decode(Modules::run("api/options", "bb_opt_category_informasi"), true);
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($info_id = 'no value') {
			
		$data['info'] = $this->info_m->get_single_info(array('i.info_id'=>$info_id));
		
		$data['breadcrumb_active'] = $data['info']->title;
		
		$_nav_list_id = $this->info_m->get_menu_info_id($info_id);
		
		$data['breadcrumb'] = $this->build_breadcrumb($_nav_list_id);
		
		$this->load->helper('navigation/navigation_h');
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function build_breadcrumb($nav_list_id) {
		
		$_nav = $this->info_m->get_menu($nav_list_id);
		
		if( $_nav->id) {
			
			$this->breadcrumb[] = $_nav;
			
			if($_nav->parent_id != 0) $this->build_breadcrumb($_nav->parent_id);
		}
		
		return array_reverse($this->breadcrumb);
	}
}
