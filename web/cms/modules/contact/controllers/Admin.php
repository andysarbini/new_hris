<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends GW_Admin {
	
	private $_prime_table = 'mdl_options';
	
	private $_prime_query = 'OPT_ID id, OPT opt, OPT_VAL val, OPT_ACTIVE acc';
	
	private $_module;
	
	private $_title = 'Kelas Administrasi';
	
	public function __construct(){
		
		parent::__construct();
		
		$this->_module = current_module();
		
		$this->load->model('foo/foo_m');
	 }
	 
	
	function index(){
		
		$this->add_edit();
	}
	
	function add_edit($_id=false){
		
		$data['title'] = 'Contact Configuration';
		
		$data['email'] = Modules::run('api/options', 'mdl_contact_email');
		
		$data['subject'] = Modules::run('api/options', 'mdl_contact_subject');
		
		$data['maps'] = Modules::run('api/options', 'mdl_contact_maps');
		
		$data['module'] = $this->_module;
		
		$this->masterpage->addContentPage('adm_form', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function simpan(){
		
		$data = array(
		
			'mdl_contact_email'=>$this->input->post('email'),
			
			'mdl_contact_subject'=>$this->input->post('subject'),
			
			'mdl_contact_maps'=>$this->input->post('maps')
		);
		
		Modules::run('options/simpan', $data);
		
		redirect(base_url().'admin/'.$this->_module);
		
	}
	
	
}
