<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logs extends GW_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('logs_m');
	}
	/*
	tampilkan 100 logs terakhir
	*/

	public function index(){

		$this->masterpage->setMasterPage(get_option('template') );

		$data = array('logs'=> $this->logs_m->get_last_logs(100) );

		$this->masterpage->addContentPage('logs', 'contentmain', $data);

		$this->masterpage->show( );
	}

	public function catat($msg = ''){

		$d = array(
			'user_id' => $this->session->userdata('user_id'),
			'name' => $this->session->userdata('name'),
			'email' => $this->session->userdata('email'),
			'ip' => $this->input->ip_address(),
			'msg' => $msg
		);

		$this->logs_m->__insert('mdl_logs', $d);
	}

	public function get_last_ip(){
		echo $this->logs_m->get_last()->ip;
	}

	public function get_last_user(){
		echo $this->logs_m->get_last()->name;
	}

	public function get_last_tgl(){
		echo $this->logs_m->get_last()->tgl2;
	}

	public function get_last_msg(){
		echo $this->logs_m->get_last()->msg;
	}

	public function get_last(){
		echo json_encode($this->logs_m->get_last());
	}
}