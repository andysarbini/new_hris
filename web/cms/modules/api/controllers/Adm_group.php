<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adm_group extends GW_Admin {
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('api_m');
	}
	
	function select(){
		
		return $this->api_m->__select('mdl_user_group', 'USR_GRP_ID id, USR_GRP_NAME title');
	}
	
	function title($_id){
		
		$t = $this->api_m->__select('mstr_active', 'ACT title', array('ACT_ID'=>$_id), false);
		return $t->title;
	}
}
