<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
		$this->load->model('register_m');
	}
	
	public function index(){

		$this->load->view('register');
	}

	public function save(){
	if($this->check_existing_nip($this->input->post('nip'))) {
		$this->load->helper('user');
		
		$data = array(
			


			'nip'	=> $this->input->post('nip'),
			'nik'	=> $this->input->post('nik'),
			'email'	=> $this->input->post('email'),
			'usr_pass'	=> gen_user_pass($this->input->post('pass')),
			
		);
		
		// if($this->input->post('pass')) {
			
			
		// 	$data['usr_pass'] = gen_user_pass($this->input->post('pass'));
		// 	// $data['key'] = gen_user_pass($this->input->post('key'));
		// }
		
		$usr_id = $this->register_m->__insert('mdl_user_temp', $data);

		$data_2 = array ('key' => gen_user_pass($usr_id));

		$this->register_m->__update('mdl_user_temp', $data_2, array ('usr_id' => $usr_id) );


		# kirim email link
		# base_url() . "register/aktivasi/?key=".$data_2['key']
	}

		redirect(base_url().'register');

	}

	Private function check_existing_nip($nip){
		
		// $nip = strtolower($this->input->post('nip'));
		
		// $nik = $this->input->post('nik') ? ' and nip <>'.$this->input->post('nik') : ''; 
		
		// $a = $this->register_m->__query("select * from mdl_user_data where nip='$nip' $nik ");

		$where = array('nip' => $nip);
		$a = $this->register_m->__select('mdl_user_data', '*', $where, false);
// dump($a);
		return count((array) $a);
	}

}