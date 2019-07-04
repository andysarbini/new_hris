<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _city extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_m');
	}
	
	function title($_idprov, $_idkab){
			$t = $this->api_m->__select('ori_master_kabupaten', 'KAB title', array('PROV_KODE'=>$this->complete_zero($_idprov), 'KAB_KODE'=>$this->complete_zero($_idkab)), false);
			return $t->title;
	}
	
	function complete_zero($number){
		$number_length = strlen($number);
		$zero_length = 2 - $number_length;
		$zero = "";
   
		for($i=1;$i<=$zero_length;$i++){
			$zero .= '0';
		}
   
		return $zero.$number;
	}
 }
