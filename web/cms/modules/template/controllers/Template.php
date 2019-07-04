<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class template extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function view($view){
		
		$this->masterpage->addContentPage($view, 'contentmain');
	
		$this->masterpage->show( );
	}
	
	
	
}
