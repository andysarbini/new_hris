<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class foo extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){
		
		echo "hello world";
	}

	function template($_path = false){

		$data['include_script'] = inc_script(
			array(
				"includes/moment/moment.min.js",
				#"includes/datepicker/bootstrap-datetimepicker.min.js",
				#"includes/datepicker/bootstrap-datetimepicker.css",
				"cms/plugin/attendance/js/revisi_form.js",
			)
		);


		$_path = $_path ? $_path : '_example';
		
		$data['title'] = 'your templating test';

		$this->masterpage->addContentPage($_path, 'contentmain', $data);
	
		$this->masterpage->show( );
	}
}