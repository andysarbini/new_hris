<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class foo extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){
		
		echo "hello world";
	}

	function template($_path = false){

		$_path = $_path ? $_path : '_example';
		
		$data['title'] = 'your templating test';

		$this->masterpage->addContentPage($_path, 'contentmain', $data);
	
		$this->masterpage->show( );
	}
}