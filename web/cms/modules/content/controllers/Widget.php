<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class widget extends GW_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->model('content_m');
	}
	
	function index(){
		
		echo  'ini widget nya';
	}
	
	function _wdg($_n = 10, $_where = array()){
		
		$_where['POST_ISACTIVE'] = 1;
		
		$data['content'] = $this->content_m->get_content($_where, 0, $_n);
		
		$this->load->view('_widget', $data);
	}
}