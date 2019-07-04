<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _active extends MX_Controller {
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('api_m');
	}
	/*
	function select(){
		
		return $this->api_m->__select('mstr_active', 'ACT_ID id, ACT title');
	}
	
	function title($_id){
		
		$t = $this->api_m->__select('mstr_active', 'ACT title', array('ACT_ID'=>$_id), false);
		return $t->title;
	}
	/**/
	function select(){
		
		return $this->api_m->__select('mstr_status', 'STAT_ID id, STAT title');
	}
	
	function title($_id){
		$t = $this->api_m->__select('mstr_status', 'STAT title', array('STAT_ID'=>$_id), false);
		return '<i class="fa '. ($_id ? 'fa-check-circle green':'fa-times-circle').'"><span class="sr-only">'.$t->title.'</span></i>';
	}
}
