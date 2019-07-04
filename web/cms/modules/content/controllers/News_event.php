<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news_event extends GW_Controller {
	
	private $_where;
	
	private $_per_page ;
	
	private $_paging_base_url;
	
	private $_paging_cfg ;
	
	private $_title;
	
	
	public function __construct(){
	
		parent::__construct();
	
		$this->load->model('content_m');
		
		$this->_paging_base_url = base_url().'content/'.current_class().'/pages/';
		
		$this->_where = array('POST_ISACTIVE'=>1, 'POST_CATEGORY'=>4); // 4 news_event
		
		$this->_per_page = 3; // <-- berapa jumlah yg ditampilakn per page
		
		$this->_title = 'News Event ';
		
		$this->_paging_cfg = array( 
		// untuk desain pagging url taruh disini
		// user_guide/libraries/pagination.html			
				'per_page' => $this->_per_page,
		
				'base_url' => $this->_paging_base_url,
				
				'use_page_numbers' => TRUE,
				
				'num_tag_open' => '<li>',
				
				'num_tag_close' => '</li>',
				
				'prev_tag_open' => '<li>',
				
				'prev_tag_close' => '</li>',
				
				'next_tag_open' => '<li>',
				
				'next_tag_close' => '</li>',
				
				'first_tag_open' => '<li>',
				
				'first_tag_close' => '</li>',
				
				'last_tag_open' => '<li>',
				
				'last_tag_close' => '</li>',
				
				'cur_tag_open' => '<li class="active"><a href="#">',
				
				'cur_tag_close' => '</a></li>',
				
				'uri_segment' => 4
		);
		
	}
	
	public function index(){
		
		$this->pages();
	}
	
	public function pages($_pages = 1){
		
		$this->load->helper('content');
	
		$data['title'] = $this->_title . $_pages ? 'Pages '.$_pages : '';
	
		$data['content'] = $this->content_m->get_content($this->_where, ($_pages -1) * $this->_per_page, $this->_per_page );
		
		// paging
		
		$this->load->library('pagination');
	
		$jml = $this->content_m->__select('vw_mdl_content_user_group', 'count(1) jml', $this->_where, false);
	
		$this->_paging_cfg['total_rows'] = $jml->jml;
		
		$this->pagination->initialize($this->_paging_cfg);
	
		$data['paging'] = $this->pagination->create_links();
	
		$this->masterpage->addContentPage('by_pages', 'contentmain', $data);
	
		$this->masterpage->show( );
	}
	
	/**
	 * detail content
	 * @param string $_id_uri
	 */
	public function view($_id_uri = false){
	
		$_where = array('POST_URI'=>$_id_uri);
	
		$data['content'] = $this->content_m->get_content($_where);
	
		$data['title'] = (isset($data['content']->title) ? $data['content']->title : 'Not Found' ) . ' | ' .$this->_title;
	
		$this->masterpage->addContentPage('view_single', 'contentmain', $data);
	
		$this->masterpage->show( );
	}
	
}
