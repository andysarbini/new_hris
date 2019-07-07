<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends GW_User
{
	function __construct(){

		parent::__construct();

		$this->load->model("bluehrd_user_m");
	}

	function index(){ }

	public function header_nav(){
		
		$this->load->model("bluehrd_user_m");
		
		$data['user'] $this->bluehrd_user_m->get_user(get_session('user_id'));
		
		$this->load->view("header_nav", $data);
	}
	
}
