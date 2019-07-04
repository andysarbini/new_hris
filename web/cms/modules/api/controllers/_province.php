<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _province extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_m');
	}
	
	function title($_id){
			$t = $this->api_m->__select('ori_master_provinsi', 'PROV title', array('PROV_KODE'=>$_id), false);
			return $t->title;
	}
}
