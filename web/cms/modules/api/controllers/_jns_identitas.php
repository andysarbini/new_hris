<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _jns_identitas extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_m');
	}
	
	function select(){
		return $this->api_m->__select('mstr_jenis_identitas', 'JNS_IDENT_ID id, JNS_IDENT title');
	}
	
	function title($_id){
			$t = $this->api_m->__select('mstr_jenis_identitas', 'JNS_IDENT title', array('JNS_IDENT_ID'=>$_id), false);
			return $t->title;
	}
}
