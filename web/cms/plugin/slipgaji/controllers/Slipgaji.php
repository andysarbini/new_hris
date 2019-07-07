<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Slipgaji extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("cuti/cuti_m");
		
		$this->load->model("slip_m");
		
		$this->usr_id = get_session("user_id");		
	}

function index(){

		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
		
				// "cms/plugin/slipgaji/js/slipgaji.js",
			)
		);
		
		$_w['year'] 	= @if_empty($this->input->get('year'),date("Y"));

		$_w['usr_id']	= $this->usr_id;
		
		$data['tables'] = $this->slip_m->get_list_slip($_w);
		
		$data['bulan']	= json_decode(Modules::run('api/options','bb_opt_bulan'), true);

		$data["slc_year"]	= $_w['year'] ; 

		$data["title"] 	= "Slip Gaji";

		$data['lowest_year'] = $this->cuti_m->get_lowest_year($this->usr_id, 'mdl_slipgaji','tahun');		
	
		$data['breadcrumb_active'] = $data['title'];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}

	
}
