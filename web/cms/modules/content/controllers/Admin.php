<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
class admin extends GW_Admin {
	 
	public function __construct(){
		
	 	parent::__construct();
		
	 	$this->load->model('content_m');
	}
	 
	 public function index(){
	 		 	
		$this->view();	
	 }
	 
	 public function view($pages = false){
		 
	 	$data['title'] = 'View All Content';
	 	
	 	$data['category_option'] = $this->category_option();
	 	
	 	$data['id_category'] = @if_empty($this->input->get('id_category'), 0);
	 	
	 	$prev_id_category = $this->session->userdata('sess_id_category');
	 	
	 	if($prev_id_category != $data['id_category']){
	 		
	 		$this->session->set_userdata('sess_id_category', $data['id_category']);
	 		
	 		$pages = 1;
	 	}
	 	
	 	if(!$pages) $pages = 1;
	 	
	 	$data['contents'] = $this->content_m->view(false, ($pages - 1) * 10, 10, $data['id_category']);
	 	 
	 	// paging begin
	 	
	 	$this->load->library('paging');
	 	
	 	$where = array();
	 	
	 	$param_paging = array('base_url'=>base_url().'admin/content/view');
	 	
	 	if($data['id_category']) {
	 		
	 		$where =  array('POST_CATEGORY'=>$data['id_category']);
	 		
	 		$param_paging['suffix'] = '?id_category=' . $data['id_category'];
	 	}
	 	
	 	$jumlah_content = $this->content_m->__select('vw_mdl_content_user_group', 'COUNT(*) jml', $where, false)->jml;
	 	
	 	$data['paging'] = $this->paging->create( $jumlah_content , $param_paging);
	 	
	 	$this->masterpage->addContentPage('admin/view_content', 'contentmain', $data);
	 	
	 	$this->masterpage->show( );
	 }
	 
	 public function add_edit($id_cont = false){

	 	@$data['referer'] = (false !== strpos($_SERVER['HTTP_REFERER'], base_url())) ? $_SERVER['HTTP_REFERER'] : base_url().'admin/content'; // dapatkan halaman yang merequest
	 	
	 	$this->load->helper('image');
	 	
		$data['title'] = 'Add Edit Content';
		
		$data['include_script'] = inc_script(array(
			'includes/ckeditor/ckeditor.js', 
			'includes/js/admin-default.js'
		));
		
		if($id_cont) $data['state'] = $this->content_m->view($id_cont);
		
		$data['category_option'] = $this->category_option();
		
	 	$this->masterpage->addContentPage('admin/form_content', 'contentmain', $data);

	 	$this->masterpage->show( );
	 }
	 
	 public function simpan(){

		$mainpage = $this->input->post('mainpage');
		
		$_p = array();
		
		foreach($_POST as $var=>$val) $_p[$var] = $this->input->post($var);
		
		$data = array(
			'POST_TITLE'=>$_p["title"],
			'POST_URI'=>$_p["uri"],
			'POST_CONTENT'=>$_p["content"],
			'POST_ISACTIVE'=>$_p["active"],
			'POST_CATEGORY'=>$_p["category"],
			'POST_DESCRIPTION'=>$_p["description"],
			'POST_TITLE_SHORT'=>$_p["title_short"],
			'POST_MAINPAGE'=>$_p["mainpage"]
		);
		
		// process if image upload
	
		$rule_upload['upload_path']   = 'uploads/images';
		$rule_upload['allowed_types'] = 'gif|jpg|png|jpeg';
		$rule_upload['encrypt_name']  = false;
		
		$this->load->library('upload',$rule_upload);
		
		if($this->upload->do_upload('feature_img')){
			$file_data = $this->upload->data();
			$data['POST_FEATURE_IMAGE'] = $file_data['orig_name'];
		}
		
		// end image upload
		
		$operasi_input = $_p["cont_id"] > 0 ? false : true; 
		
		if(!$operasi_input) $data = array_merge($data, array('POST_ID'=> $_p["cont_id"]));
			
		$row = $this->content_m->simpan($data, $operasi_input);
		
		if($row ) {

			if($referer = $this->input->post('referer'))  redirect($referer);

			else redirect(base_url().'admin/content/');
		}

		else  echo 'error database operation' . $this->content_m->__error();
	 }
	 
	 public function delete($post_id){
		 $this->content_m->delete($post_id);
		
		 //$referer =  $this->input->get('referer');
	 	
		 redirect(base_url().'admin/content');
	 }
	 
	 public function category_option(){
		 return $this->content_m->__select('mdl_content_category', 'CAT_ID id, CAT_TITLE title');
	 }
	 
	 
 }
?>
