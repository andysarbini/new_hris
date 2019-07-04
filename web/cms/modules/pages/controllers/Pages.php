<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * 
 */
class pages extends GW_Controller //MX_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('pages_m');
		//$this->masterpage->setMasterPage('templates/'. get_option('template') );
	}
	
	public function index($_uri = false){
		
		if($_uri) {
			
			
			$data['_uri'] = $this->check_child_uri_pages();
			//dump_exit($data['_uri']);
			$data['pages'] = $this->pages_m->get_pages( end($data['_uri']) );
			
			//$data['breadcrumb'] = $this->create_breadcrumb($data['_uri']);
		
			//$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			
			@$data['template_title'] = $data['pages']->title;
			
			$this->masterpage->addContentPage('contentmain', 'contentmain', $data);
		
		} else {
		
			@$data['template_title'] = 'Main Page';

			$this->load->model('content/content_m');

			$a = $this->content_m->get_content(array('POST_MAINPAGE'=>1));
			
			$data['content'] = $a[0]->content;
			
			$this->masterpage->addContentPage('mainpage', 'contentmain', $data);
		}
		
		$this->masterpage->addContentPage('widget', 'widget', $data);
		
		$this->masterpage->show( );
		
	}
	
	private function check_child_uri_pages($_uri = false){
		
		return child_uri_pages($_uri);
	}
	
	private function create_breadcrumb($_uri = array()) {
		$_duri = array();
		foreach($_uri as $u)
			$_duri[$u] = $this->pages_m->get_title($u);
		return $_duri;
	}
	
}
