<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
class break_models extends GW_Controller{
	
	function __construct(){

		parent::__construct();
		
		$this->load->model('break_m');
	}
	
	function index(){
		echo '<pre>';
		var_dump($this->break_m->select_from_property());
		echo '</pre>';
	}
	
	function break_active_record(){
		
	
	}	
	
}
