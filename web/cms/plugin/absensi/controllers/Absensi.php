<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class absensi extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){

		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Hello..';
	
		$this->masterpage->addContentPage('form_absen', 'contentmain', $data);

		$this->masterpage->show( );
	}


	public function profil(){
		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Profil';
	
		$this->masterpage->addContentPage('profil_kar', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	
	
}
