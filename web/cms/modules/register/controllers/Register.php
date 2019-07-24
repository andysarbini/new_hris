<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
		$this->load->model('register_m');
	}
	
	public function index(){

		$this->load->view('register/register');
	}

	function save(){
		

		$data = array(
			
			'nip'	=> $this->input->post('nip'),
			'nik'	=> $this->input->post('nik'),
			'email'	=> $this->input->post('email'),
			
		);
		
		if($this->input->post('pass')) {
			
			$this->load->helper('user');
			
			$data['usr_pass'] = gen_user_pass($this->input->post('pass'));
		}
		$this->register_m->__insert('mdl_user_temp', $data);

		redirect(base_url().'register');

	}
}