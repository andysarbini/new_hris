<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author g3n1k
 */
class user extends MX_Controller {

	public $msg = false;

	public function __construct() {

		parent::__construct();

		$this->masterpage->setMasterPage('templates/login');
	#	$this->masterpage->setMasterPage('login');
	}

	public function index(){
		$this->login();
	}

	public function login()	{

		$this->load->helper('form');

		$data['email'] = $this->input->post('email');

		$data['password'] = $this->generate_md5($this->input->post('password'));
		# no-captcha
		/*
		$data['captcha'] = $this->input->post('captcha');
		*/
		if( $this->input->post('submit') ){
			unset($_POST['submit']);

			# no-captcha
			/*
			if(!$data['captcha'] || $data['captcha'] !== $this->session->userdata('captcha_word')) {

				$this->msg = 'error';

				$this->login_form();
			}

			else {
			/**/
				$this->form_validation->set_rules('email', 'Email', 'required');

				$this->form_validation->set_rules('password', 'Password', 'required');

				if ( !$this->form_validation->run() )  

					$this->login_form($data);

				else { 

					$this->load->model('login_m');

					$user =  $this->login_m->login_user($data);

					if( count((array)$user) ){

						$this->session->set_userdata($user);

						Modules::run('logs/catat', 'user login');

						if(strtolower($user['group_name'])==='admin') redirect(get_option('redirect_after_login_'.strtolower($user['group_name'])));

						else redirect(base_url());

					} else { // error user password

						$this->msg = 'error'; 

						$this->login_form();

					}
				}
			# no-captcha
			//}
		} else
			is_login() ? redirect( get_option('redirect_after_login_'.$this->session->userdata('group_name'))) : $this->login_form();
	}

	private function login_form(){

		$data['title'] = 'Login Page';

		if( $this->msg ) {

			$data['error'] = $this->msg;

			$this->msg = false;
		}

		$this->masterpage->addContentPage('login_form', 'contentmain', $data);

		$this->masterpage->show( );

	}

	public function logout(){

		$this->session->sess_destroy();

		redirect(base_url().'login');
	}

	/**
	 * generate md5 untuk password
	 */ 
	public function generate_md5($pass){
		
		$this->config->load('user');
		
		return md5($pass. $this->config->item('hash'));
	}
	
}
