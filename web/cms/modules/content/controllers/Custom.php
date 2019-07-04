<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * custom dari class content
 */
class custom extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('content_m');
	}
	
	public function get_content($_id=false){
		return $this->content_m->view($_id);
	}
	
	public function index(){
		echo  'hello world';
	}
	
	public function get($_id=false){
		
		$content = $this->content_m->view($_id);
	}
}

