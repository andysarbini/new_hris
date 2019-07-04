<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adm_member extends GW_Admin {
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('_member_m');
	}
	
	function get_member(){
		
		if(isset($_GET['term'])){
			
			$term = $this->input->get('term');
			
			$this->_member_m->get_all_member($term);
			
		} else {
			echo 'not parammer given';
		}
	}
	
	function get_all_members(){
		return $this->_member_m->getmember();
	}
		
}
