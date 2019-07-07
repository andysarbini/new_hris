<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Slipgaji extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("attendance/att_m");
		
	}

	function index(){

		$data["title"] = "Slip Gaji";
/*
		$data['include_script'] = inc_script(
			array(				
				"cms/plugin/attendance/css/calender.css",
			)
		);
*/		
		$data["year"] 	= @if_empty(getVar("year")) ? getVar("year") : date("Y");

		$data["month"] 	= @if_empty(getVar("month")) ? getVar("month") : date("n");
		
		$data["usr_id"] = get_session('user_id');
		
		$this->load->model("cuti/cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($data["usr_id"]);

		$data["max_year"] = date("Y") + 1;
		
		#$this->load->helper("attendance/attendance");

		#$data["att"]	= att_to_array($this->att_m->get_attendance($data["usr_id"], $data["year"], $data["month"]));
	
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}

	
}
