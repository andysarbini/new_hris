<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends GW_User {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){

		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Hello..';
	
		$this->masterpage->addContentPage('home', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	
	
}
