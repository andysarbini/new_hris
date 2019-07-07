<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("att_m");

		$this->usr_id = get_session("user_id");
		
	}

	// tampilan untuk user
	function index(){
		
	}
	
	function get_single_attendance(){
		
		$_p = array();
		
		foreach($_POST as $var=>$val) $_p[$var] = $this->input->post($var);
		
		$_p["date_in"] = $_p["year"]."-".$_p["month"]."-".$_p["date"];
		
		$data["att"] = $this->att_m->get_single_attendance($_p["usr_id"], $_p["date_in"]);
		
		$this->load->view("single_attendance", $data);
	}


}
