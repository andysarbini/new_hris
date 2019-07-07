<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends GW_User {

	function __construct(){
	
		parent::__construct();		
	}

	// tampilan untuk user
	function index(){
		
	}
	
	public function bluehrd_user_data(){
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$data["user"] = $this->bluehrd_user_m->get_user(get_session('user_id'));
		
		$this->load->view("header_nav", $data);
	}
	
}
