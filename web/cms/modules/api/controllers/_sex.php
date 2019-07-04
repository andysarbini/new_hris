<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _sex extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_m');
	}
	
	function select(){
		return $this->api_m->__select('mstr_sex', 'SEX_ID id, SEX title');
	}
	
	function title($_id){
			$t = $this->api_m->__select('mstr_sex', 'SEX title', array('SEX_ID'=>$_id), false);
			return $t->title;
	}
}
