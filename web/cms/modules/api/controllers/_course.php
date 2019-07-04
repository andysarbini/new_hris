<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _course extends MX_Controller {
	
	function __construct(){

		parent::__construct();
		
		$this->load->model('_course_m');
	}
	
	public function index(){

		echo 'hello from '.current_class();
	}
	
	public function by_day($_id = false){
		
		$data['DAY_ID'] = $this->input->post('day_id');
		$data['KLS_ID'] = $this->input->post('class_id');
		
		echo gen_option_html($this->_course_m->get_by($data, 'KLS_ID id, KLS title', 'KLS_ID'), @if_empty($data['KLS_ID'],0));
		//echo gen_option_html( $this->_course_m->get_class_by_day($_id));
	}
	
	public function by_class(){
		
		$data['DAY_ID'] = $this->input->post('day_id');
		$data['KLS_ID'] = $this->input->post('class_id');
		$data['LSN_ID'] = $this->input->post('course_id');
		
		echo gen_option_html($this->_course_m->get_by($data, 'LSN_ID id, LSN_NAME title', 'LSN_ID'), @if_empty($data['LSN_ID'],0));
	}
	
	
	public function by_course(){
		$data['DAY_ID'] = $this->input->post('day_id');
		$data['KLS_ID'] = $this->input->post('class_id');
		$data['LSN_ID'] = $this->input->post('course_id');
		$data['JWL_ID'] = $this->input->post('jadwal_id');
		
		echo gen_option_html($this->_course_m->get_by($data, 'JWL_ID id, JWL_TIME title'), @if_empty($data['JWL_ID'],0));
	}
}
