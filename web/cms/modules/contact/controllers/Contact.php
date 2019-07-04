<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * contact form 
 * 
 */
class contact extends MX_Controller
{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		//echo $this->captcha();
		//dump($this->session->userdata('captcha_sess'));
		$this->load->view('contact_form');
	}
	
	function send(){
		//echo 'send init';
		// cek captcha first
		$captcha_sess = $this->session->userdata('captcha_sess');
		if(strtolower($this->input->post('captcha')) === strtolower($captcha_sess['word'])){
			$this->config->load('contact_cfg');
			
			$nama 	= $this->input->post('name');
			$email	= $this->input->post('email');
			$subjek	= get_option('subjek');
			#$msg	= nl2br($this->input->post('msg'));
			$msg	= $this->load->view('message','', true);
			
			$this->load->library('email');
			
			$this->email->initialize(get_option('mail_cfg'));
			
			$this->email->from($email, $nama);
			$this->email->to( Modules::run('api/options', 'mdl_contact_email') );
			$this->email->subject(Modules::run('api/options', 'mdl_contact_subject'));
			$this->email->message($msg);
			$this->email->send();
			#echo $this->email->print_debugger();
			echo 1;
		} else {
			
			echo 0;
		}
		//echo $this->input->post('captcha') .' xxx '. $captcha_sess['word'];
	}
	
	function fr(){
	
		$this->load->view('franchise_form');
	}
	
	function sendfr(){
		
		$captcha_sess = $this->session->userdata('captcha_sess');
		
		if(strtolower($this->input->post('captcha')) === strtolower($captcha_sess['word'])){

			$this->config->load('contact_cfg');
			$nama 	= $this->input->post('First_Name').' '.$this->input->post('Last_Name');
			$email	= $this->input->post('Email');
			$subjek	= 'Franchise Contact Form';
			$msg	= $this->load->view('message','', true);
				
			$this->load->library('email');
				
			$this->email->initialize(get_option('mail_cfg'));
				
			$this->email->from($email, $nama);
			$this->email->to( Modules::run('api/options', 'mdl_contact_email') );
			$this->email->subject($subjek);
			$this->email->message($msg);
			$this->email->send();
			#echo $this->email->print_debugger();
			echo 1;
		} else {
				
			echo 0;
		}
	}
	
	
	function cv(){
		$data['maps'] = Modules::run('api/options', 'mdl_contact_maps');
		$this->load->view('cv_form', $data);
	}
	
	function sendcv(){
	
	
		# get upload file
		$this->load->library('upload');
		
		$contact_url = str_replace('/?s=fail', '', $_SERVER['HTTP_REFERER']);
		$contact_url = str_replace('/?s=success', '', $contact_url);
	
		if( $this->session->userdata('captcha_word') !== $this->input->post('captcha') || $_FILES['cv']['size'] > 0) {
					
			$aConfig['upload_path']      = 'uploads/cv/';
			$aConfig['allowed_types']    = 'docx|pdf|odt|doc';
			$aConfig['max_size']     = '2048';
			$this->upload->initialize($aConfig);
	
			if($this->upload->do_upload('cv'))	$ret = $this->upload->data();
			
			else redirect($contact_url.'/?s=oversized'); 
			
			$pathToUploadedFile = $ret['full_path'];
	
			// send mail
				$this->config->load('contact_cfg');
		
			$nama 	= $this->input->post('name');
			$email	= $this->input->post('email');
			$subjek	= 'Drop CV';
			$msg	= $this->load->view('message','', true);
						
			$this->load->library('email');
	
			$this->email->initialize(get_option('mail_cfg'));

			$this->email->from($email, $nama);
			$this->email->to( Modules::run('api/options', 'mdl_contact_email') );
			$this->email->subject($subjek);
			$this->email->message($msg);
			$this->email->attach($pathToUploadedFile);
			$this->email->send();
			#echo $this->email->print_debugger();
			#echo true;
			unlink($pathToUploadedFile);
				
			//echo 'pathToUploadedFile:'.$pathToUploadedFile;
			//$this->session->set_userdata('send_cv_success',1);
			
			redirect($contact_url.'/?s=success');
		
		} else 
			redirect($contact_url.'/?s=fail');
	}
	
	/**
	 * buat captha,
	 * simpan word nya dalam session
	 * send => kirim semua data, 
	 * jika captcha nya gagal
	 * refresh captcha = buat captcha baru

Dump => array(3) {
  ["word"] => string(6) "eliy3g"
  ["time"] => float(1374644599.25)
  ["image"] => string(133) " "
}

	 
	function captcha(){
		
		$this->load->helper('captcha');

		$vals = array(
			'word' => gen_pass(4),
			'img_path' => './includes/captcha/',
			'img_url' => base_url().'/includes/captcha/',
			'font_path' => './includes/fonts/molten.ttf',
			'img_width' => '150',
			'img_height' => 50,
			'expiration' => 7200
		);
		
		$cap = create_captcha($vals);
		
		$tmp = $this->session->userdata('captcha_sess');
		@unlink($vals['img_path'].$tmp['time'].'.jpg');
		
		$this->session->set_userdata(array('captcha_sess'=>$cap));
		
		echo $cap['image'];
	
	}
	*/ 
	function captcha(){
		
		$this->load->library('antispam');

		$configs = array(
			//'word' => gen_pass(4),
			'img_path' => '../includes/captcha/',
			'img_url' => base_url().'/includes/captcha/',
			'img_height' => 50,
			'img_width' => 150,
			'font_path' => './includes/fonts',
			'char_length' => 4
		);
		
		$captcha = $this->antispam->get_antispam_image($configs);
		
		#$captcha_sess = $this->session->userdata('captcha_sess');
		#echo dump($captcha_sess);
		#echo dump($captcha);
		#unlink($configs['img_path'].$captcha_sess['captcha_sess'].'.jpg');
		
		$this->session->set_userdata(array('captcha_sess'=>$captcha));
		
		//echo $captcha['image'].$captcha['word'];
		echo $captcha['word'];
	
	}
	
	function cek_captcha($str_captcha){
		
		$tmp = $this->session->userdata('captcha_sess');
		
		if( strtolower($tmp['word']) === strtolower($str_captcha)) return 1;
		
		else return 0;
	}
	
}
