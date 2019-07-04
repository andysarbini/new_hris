<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _404 extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index(){
		
		$_group = $this->session->userdata('group_name');
		
		if($_group == 'admin') redirect(base_url()."admin");
		
		elseif($_group == '') redirect(base_url()."logout");
			
		else redirect(base_url());
	}	
}
