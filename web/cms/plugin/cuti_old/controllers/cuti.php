<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cuti extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("cuti_m");

		$this->usr_id = get_session("user_id");
		
	}

	// tampilan untuk user
	function index(){

		$data['include_script'] = inc_script(
			array(
				"includes/datepicker/bootstrap-datepicker.js",
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
				"cms/plugin/cuti/js/cuti.js",
			)
		);

		$usr_id 	= get_session("user_id");

		$data["slc_year"]	= isset($_GET["year"]) ? $this->input->get("year") : date("Y"); 

		$data["title"] 	= "Izin Cuti";

		$data["lowest_year"] = $this->cuti_m->get_lowest_year($this->usr_id);

		$this->masterpage->addContentPage('user', 'contentmain', $data);

		$this->masterpage->show( );
	}

	function year($year = null){

		if(!$year) $year = date("Y"); 

		$usr_id = get_session("user_id");
		
		$data["cuti"] = $this->cuti_m->get_list_cuti_year($this->usr_id, $year);

		$this->load->view("list_cuti_year", $data);
	}

	function create(){
		
		$data = array();
		
		$data["tgl_to"] = $this->input->post("tgl_to");

		$data["tgl_from"] = $this->input->post("tgl_from");

		$data["usr_id"] = $this->usr_id;

		$result = $this->cuti_m->__insert("mdl_cuti", $data);

		if($result) {

			$name = $this->cuti_m->__select("mdl_user_data", "nama_lengkap", array("usr_id"=>$this->usr_id), false)->nama_lengkap;
		
			$_notif["title"] = $name . " mengajukan cuti";

			$_notif["url"]	= base_url()."cuti/admin/?highlight=".$result;

			//dump($_notif, "_notif");

			Modules::run("notification/set", $_notif);
		}
		
		$tgl_from = explode("-", $data["tgl_from"]);
		
		redirect( base_url()."cuti/?year=". $tgl_from[0] );
	}
}
