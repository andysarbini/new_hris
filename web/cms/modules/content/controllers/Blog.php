<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends GW_Controller {
	
	private $_where;
	
	private $_per_page ;
	
	private $_paging_base_url;
	
	private $_paging_cfg ;
	
	private $_title;
	
	private $_cfg;
	
	private $_prim_table = 'vw_mdl_content_user_group';
	
	public function __construct(){
	
		parent::__construct();
	
		$this->load->model('content/content_m');
		
		$cat_uri = $this->uri->segment(1); // with seo
		
		// config load here
		$var_config = str_replace("-", "_", $cat_uri);
		$this->load->config('config');
		$this->_cfg = $this->config->item($var_config);
		
		$this->_where = array('POST_ISACTIVE'=>1, 'CAT_URI'=>$cat_uri);
		
		$this->_paging_base_url = base_url().$cat_uri;
		
		// number post to load in thumbs
		$this->_per_page = @if_empty(Modules::run('api/options','cfg_thumb_per_page'), 10); // <-- berapa jumlah yg ditampilakn per page
		
		$this->_title = $this->content_m->__select('mdl_content_category', 'CAT_TITLE cat_title', array('CAT_URI'=>$cat_uri), false)->cat_title;
		dump($this->content_m->__last_query());
	}
	
	public function index(){
		$this->category();
	}
	//http://192.168.0.120/hmvc_rafa/news-event/2
	public function category($_category = null, $_pages = false){

		$this->load->helper('image');

		if(!$_category) $_category = $this->uri->segment(1);

		if(!$_pages || !is_numeric($_pages)) { 
			$_pages = $this->uri->segment(2); 
			if(!$_pages || !is_numeric($_pages)) { $_pages = 1; }
		}
		
		$data['pages'] = $_pages;

		$this->load->helper('content');
	
		$data['template_title'] = $this->_title ? $this->_title . ' - Pages '.$_pages : '';
	
		$data['contents'] = $this->content_m->get_content($this->_where, ($_pages -1) * $this->_per_page, $this->_per_page );
	
		
		// paging setup
		
		$this->load->library('paging');
		
		$jml = $this->content_m->__select('vw_mdl_content_user_group', 'count(1) jml', $this->_where, false);
		
		$cfg_paging		= array(
					
				'base_url'=>base_url().$_category.'/',
		
				'use_page_numbers'=>TRUE,
		
				'uri_segment' => 2
		);
		
		$data['paging']		= $this->paging->create($jml->jml, $cfg_paging);
		
		// check if file exist
		$_view_page = dirname(dirname(__FILE__)).'/views/'.$this->uri->segment(1).'_pages.php';
		
		$_view_page = file_exists($_view_page) ? $this->uri->segment(1).'_pages' : 'by_pages';
		
		$this->masterpage->addContentPage($_view_page, 'contentmain', $data);
	
		$this->masterpage->show( );
	}
	
	/**
	 * detail content
	 * @param string $_id_uri
	 */
	
	public function view(){
	
		$_where = array('POST_URI'=>$this->uri->segment(3), 'CAT_URI'=>$this->uri->segment(1));
		
		$data['content'] = $this->content_m->get_content($_where);
		
		$this->load->library('prevnext');
		
		$_id_uri = $_where['POST_URI'];
		
		$this->prevnext->set('vw_mdl_content_user_group', 'POST_URI', 'POST_URI uri, POST_TITLE title', 'POST_ID', $_id_uri, $this->_where);
		
		$data['_next'] = $this->prevnext->next();

		$data['_prev'] = $this->prevnext->prev();
		
		$data['_back'] = str_replace('/'.$_where['POST_URI'],'',full_url());
		
		$data['title'] = (isset($data['content']->title) ? $data['content']->title : 'Not Found' ) . ' | ' .$this->_title;
		
		#$sidebar['content_n'] = $this->content_m->get_content($this->_where);
	
		#$this->masterpage->addContentPage('get_n_content', 'Sidebar', $sidebar);
		
		$_view_page = dirname(dirname(__FILE__)).'/views/'.$this->uri->segment(1).'_single.php';
		
		$_view_page = file_exists($_view_page) ? $this->uri->segment(1).'_single' : 'view_single';
		
		$this->masterpage->addContentPage($_view_page, 'contentmain', $data);
	
		$this->masterpage->show( );
	}
	
}
