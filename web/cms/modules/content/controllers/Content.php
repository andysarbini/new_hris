<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends GW_Controller {
	
	
	private $_prime_tbl = 'mdl_content';
	
	private $_prime_query = 'POST_TITLE title, POST_URI uri,POST_CONTENT content';
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model('content_m');
	}
	/**
	 * untuk thumb category berdasarkan category 
	 * @param unknown $_group_id
	 */
	 
	// default view content by uri or id
	public function index($_uri = false){
		//redirect(base_url());
		
		$_where = is_numeric($_uri) ? array('POST_ID'=>$_uri) : array('POST_URI'=>$_uri); 
		
		$data['pages'] = $this->content_m->__select($this->_prime_tbl, $this->_prime_query, $_where, false);
		
		$data['template_title'] = $data['pages']->title;
		
		$this->masterpage->addContentPage('single', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	
	
	public function select($_id=0){
		$data['options'] = $this->content_m->view();
		$data['selected'] = $_id;
		return $this->load->view('select',$data);
	}
	
	/**
	 * 13.10.2013 22:18:33
	 * get single content, or choose what u want to show
	 */
	public function _get($_uri, $_target=false, $show = false){
		
		$_where = is_numeric($_uri) ? array('POST_ID'=>$_uri) : array('POST_URI'=>$_uri); 
		
		$pages = $this->content_m->__select($this->_prime_tbl,$this->_prime_query, $_where, false);
		//dump($pages);
		if($_target && $show) $this->load->view('show_just_content',array( 'contentx'=>$pages), false);
		
		if($_target && !$show) return $pages->$_target;
		
		else return $pages;
	}
	
	public function ping(){
		echo 'hello njink';
	}
	
}
