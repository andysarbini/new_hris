<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profil extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){

		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Profil Karyawan.';
	
		$this->masterpage->addContentPage('profil_kar', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	
	
}
