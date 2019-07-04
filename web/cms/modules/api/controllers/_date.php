<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _date extends MX_Controller {
	
	function __construct(){

		parent::__construct();
		
		$this->load->model('api_m');
	}
	
	public function index(){

		echo 'hello from '.current_class();
	}
	
	public function time2day($tgl = false){
		
		if(! $tgl) $tgl = $this->input->post('tgl');
		
		echo $tgl ? @date('w', @strtotime(str_replace('-', '/', $tgl)) ) : 'what the ??';
	}
	
	public function _master_day(){
		return $this->api_m->__select('mstr_day', 'DAY_ID id, DAY_DAY title');
	}
	
	public function get_hari( $_id = 0){
		echo json_encode($this->api_m->__select('mstr_day', 'DAY_ID id, DAY_DAY title', array('DAY_ID'=>$_id),false));
	}
	
	public function _loopN($n=0){
		
		$ary = array();
		
		for($i = 0; $i < $n; $i++){
			
			 $ary[] = $i > 9 ? array('id'=>$i, 'title'=>$i) : array('id'=>'0'.$i, 'title'=>'0'.$i);
		}
		
		return $ary;
	}
	
	public function course_by_day($_id, $select=''){
		
		echo gen_option_html($this->api_m->get_course_by_day($_id), $select);
	}
	
	public function jam_course_by_day($_id_day = false, $_id_course = false, $select=''){
		
		echo gen_option_html($this->api_m->get_jam_by_course_day($_id_day, $_id_course), $select);
	}
}
