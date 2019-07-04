<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * halaman ini user login menggunakan user dan pass
 * 
 */ 
	 
class admin extends GW_Admin {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('content/content_m');
	 }
	 
	
	function index(){
		$this->view();
	}
	
	function view(){
		
		$data['title'] = 'All Category';
		
		$data['contents'] = $this->content_m->__select('mdl_content_category', 'CAT_ID id, CAT_TITLE title, CAT_KET ket, ACTIVE acc');
		
		$this->masterpage->addContentPage('view_category', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function add_edit($_id=false){
		
		$data['title'] = 'Add Edit Category';
		
		if($_id) $data['cat'] = $this->content_m->__select('mdl_content_category', 'CAT_ID id, CAT_TITLE title, CAT_URI uri, CAT_KET ket, ACTIVE acc', array('CAT_ID'=>$_id), false);
		
		$this->masterpage->addContentPage('form_category', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function simpan(){
		
		$_id = $this->input->post('cat_id');
		
		$_title = $this->input->post('cat_title');
		
		$_ket = $this->input->post('cat_ket');
		
		$_acc = $this->input->post('is_active');
		
		$_uri = $this->input->post('cat_uri');
		
		
		$data = array(
		
			'CAT_ID'=>$_id,
		
			'CAT_TITLE'=>$_title,
			
			'CAT_URI'=>$_uri,
		
			'CAT_KET'=>$_ket,
			
			'ACTIVE'=>$_acc
		);
		
		//dump($data);
		
		$success = $_id ? $this->content_m->__update('mdl_content_category', $data, array('CAT_ID'=>$_id)) : $this->content_m->__insert('mdl_content_category', $data);
		
		$this->content_m->__update('mdl_content', array('POST_ISACTIVE'=>$data['ACTIVE']), array('POST_CATEGORY'=>$data['CAT_ID']));
		//die('success:'.$success);
		//if($success) 
		redirect(base_url().'admin/category/view');
		
		//else die('error writing to database '. $this->content_m->__error());
	}
	
	function hapus($_id = false){
		
		$this->content_m->__delete('mdl_content_category', array('CAT_ID'=> $_id));
		
		redirect(base_url().'admin/category');
	}
	
}
