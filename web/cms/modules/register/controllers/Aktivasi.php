<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aktivasi extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
		$this->load->model('register_m');
	}
	
	public function index(){

		$where = array('key'=>$this->input->get('key'));
		$user = $this->register_m->__select('mdl_user_temp', '*', $where, false);

		if(@if_empty($user->key)){
		// dump($user);
			$data = array(
			'USR_EMAIL'	=> $user->email,
			'USR_PASS'  => $user->usr_pass,
			'USR_NAME'	=> $user->email,
			'USR_ACCESS' => 1,
			'USR_GRP_ID' => 3);

			$userid = $this->register_m->__insert('mdl_user', $data);
			$this->register_m->__update('mdl_user_data', array('usr_id'=> $userid), array('nip'=> $user->nip));
			$this->register_m->__delete('mdl_user_temp', $where);
			}
		redirect(base_url().'login');
	}

	
	function check_existing_nip(){
		
		$nip = strtolower($this->input->post('nip'));
		
		$nik = $this->input->post('nik') ? ' and nip <>'.$this->input->post('nik') : ''; 
		
		$a = $this->register_m->__query("select * from mdl_user_temp where nip='$nip' $nik ");

		echo json_encode(count($a));
	}

}