<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("att_m");
		
	}

	function index(){

		$data["title"] = "Laporan Kehadiran";

		$data['include_script'] = inc_script(
			array(				
				"cms/plugin/attendance/css/calender.css",
			)
		);
		
		$data["year"] 	= @if_empty(getVar("year")) ? getVar("year") : date("Y");

		$data["month"] 	= @if_empty(getVar("month")) ? getVar("month") : date("n");
		
		$data["usr_id"] = get_session('user_id');
		
		#$this->load->model("cuti/cuti_m");
		$this->load->model("cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($data["usr_id"]);

		$data["max_year"] = date("Y") + 1;
		
		$this->load->helper("attendance");
		
		$this->load->helper("cuti/cuti");
		
		$_usr = get_user(array("d.usr_id"=>$data["usr_id"]));

		$data["att"]	= att_to_array($this->att_m->get_attendance($_usr->nip, $data["year"], $data["month"]));
		
		$data['breadcrumb_active'] = $data["title"];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}

	function masuk(){ // in or out
		
		$data['include_script'] = inc_script(
			array(				
				"cms/plugin/attendance/masuk_keluar.js",
			)
		);
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('button_attendance', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
}
