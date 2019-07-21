<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("att_m");

		$this->usr_id = get_session('user_id');
	}

	function index(){

		$data["title"] = "Laporan Kehadiran";

		$data['include_script'] = inc_script(
			array(				
				"cms/plugin/attendance/css/calender.css",
				"templates/inspinia/js/plugins/fullcalendar/moment.min.js",
				"templates/inspinia/js/plugins/fullcalendar/fullcalendar.min.js",
				"templates/inspinia/css/fullcalendar/fullcalendar.print.css",
				"templates/inspinia/css/fullcalendar/fullcalendar.css",
			)
		);
		
		$data["year"] 	= @if_empty(getVar("year")) ? getVar("year") : date("Y");

		$data["month"] 	= @if_empty(getVar("month")) ? getVar("month") : date("n");
		
		$data["usr_id"] = get_session('user_id');
		
		$this->load->model("cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($data["usr_id"]);

		$data["max_year"] = date("Y") + 1;
		
		$this->load->helper("attendance");
		
		$this->load->helper("cuti/cuti");
		
		$_usr = get_user(array("d.usr_id"=>$data["usr_id"]));
		
		//$data["att"]	= att_to_array($this->att_m->get_attendance($_usr->nip, $data["year"], $data["month"]));
		$_att = $this->att_m->get_attendance($_usr->nip, $data["year"], $data["month"]);
		
		$data['att'] = json_decode($this->load->view('att_json', array('att'=>$_att), true), true);

		$data['breadcrumb_active'] = $data["title"];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
	/**
	 * fungsi absensi keluar masuk
	 */
	function att($_id = false){ // in or out
		
		$data['include_script'] = inc_script(
			array(
				"includes/geo/geoPosition.js",
				"includes/geo/geoPositionSimulator.js",
				"cms/plugin/attendance/js/masuk_keluar.js",
			)
		);
		
		$data['att_id'] = $_id ? $_id : 0;

		// get office user
		$_ = $this->att_m->__select('mdl_user_office', 'office_id', array('usr_id'=>$this->usr_id), false);
		
		$_off = json_decode($_->office_id, true);

		$_where = 'office_id in ('.implode(',', $_off).')';

		// get selected office
		$_offices = $this->att_m->__select('mdl_office', 'office_id id, office title', $_where);

		$offices = array();
		// ubah array ke format yg di terima fungsi gen_option_html
		foreach($_offices as $_var=>$_) $offices[] = array('id'=>$_->id,'title'=>$_->title);
		
		$data['offices'] = $offices;

		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('button_attendance', 'contentmain', $data);

		$this->masterpage->show( );
	}
}
