<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * halaman ini user login menggunakan user dan pass
 *
 */
class admin extends GW_Admin {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model('gallery_m');
	}
	
	public function index(){
		$this->view();
	}
	
	public function view(){
		$data['title'] = 'View All Gallery';
		$data['state'] = $this->gallery_m->view();
		//dump($this->gallery_m->__last_query());
		$this->masterpage->addContentPage('admin/view_gallery', 'contentmain', $data);
		$this->masterpage->show( );
	}
	
	public function add_edit($id = false){
		$data['title'] = 'Add Edit Gallery';
		if($id) $data['state'] = $this->gallery_m->view($id);
		$this->masterpage->addContentPage('admin/form_gallery', 'contentmain', $data);
		$this->masterpage->show( );
	}
	
	public function simpan(){
		$operasi_input = false;
		$_id = $this->input->post('gall_id');
		if(!$_id) $operasi_input = true;
		
		$name	= $this->input->post('name');
		$uri	= $this->input->post('uri');
		$desc	= $this->input->post('desc');
		
		$_tmp	= $this->input->post('template');
		$_tmp_id= $this->input->post('template_id');
		
		$tmp	= $_tmp_id ? $_tmp_id : ($_tmp ? $_tmp : 'carousel');
		//dump($_tmp);dump($_tmp_id);dump($tmp);die();
		$data = array(
			'GALL_NAME'=>$name,
			'GALL_URI'=>$uri,
			'GALL_DESC'=>$desc,
			'GALL_TEMPLATE'=>$tmp
		);
		//dump($data);die();
		if(!$operasi_input) // edit
			$data = array_merge($data, array('GALL_ID'=>$_id));
			
		$row = $this->gallery_m->simpan($data, $operasi_input);
		if($row ) echo redirect(base_url().'admin/gallery');
		else  echo 'error database operation';
	}
	
	/**
	 * view gallery and list image
	 */
	public function detail($_id=false){
		
		$data['title'] = 'View All Image Gallery';
		
		$this->load->helper('image');
		
		$this->load->config('gallery');
		
		$data['directory'] = $this->config->item('mdl_gallery_upload_path');
		
		$data['gall']  = $this->gallery_m->view($_id);
		
		$data['state'] = $this->gallery_m->view_image($_id);
		
		$this->masterpage->addContentPage('admin/view_gallery_images', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	/**
	 * 
	 */
	public function add_edit_img($_id_gall=false, $_id_pic=false){
			
			$data['title'] = 'Add Edit Image Gallery';
			
			// load config
			$this->load->config('gallery');
			
			$data['directory'] = $this->config->item('mdl_gallery_upload_path');
			
			$data['mdl']  = $this->gallery_m->view_img($_id_gall, $_id_pic);
			
			@$data['txt_content'] = $data['mdl']->post_id ? $this->load_content($data['mdl']->post_id, false):''; 
			
			//$data['content_option'] = $this->get_link_content();
			
			$data['gall_id'] = $_id_gall;
			
			$this->masterpage->addContentPage('admin/form_image', 'contentmain', $data);
			
			$this->masterpage->show( );
	}
	
	/**
	 * engine to save image in gallery
	 * upload
	 * input to database
	 */
	public function simpan_img(){
		
		$name	= $this->input->post('name');
		$gall_id= $this->input->post('gall_id');
		$pic_id = $this->input->post('pic_id');
		$desc	= $this->input->post('description');
		$main	= $this->input->post('main');
		
		// load config
		$this->load->config('gallery');
		#$directory = $this->config->item('mdl_gallery_upload_path');
		$directory = Modules::run('api/options', 'mdl_gallery_upload_path');
		
		// rule upload
		$rule_upload['upload_path']   = $directory;
		$rule_upload['allowed_types'] = 'gif|jpg|png|jpeg';
		$rule_upload['encrypt_name']  = false;
		
		$this->load->library('upload',$rule_upload);
		
		// kalo dia insert pertama kali tanpa image -> error
		if ( ! $this->upload->do_upload('image') && !$pic_id)
			die($directory.' : '.$this->upload->display_errors());
		
		else // klo update, cek dulu apa punya upload atau tidak
		{
			
			// simpan content
			$content_id = $this->input->post('id_content');
			$content	= $this->input->post('txt_content');
			
			//die(dump($content));
			
			$post = array(
				'POST_TITLE'=>$name,
				'POST_URI'=>to_uri($name),
				'POST_CONTENT'=>$content,
				'POST_INPUT_BY'=> $this->session->userdata('user_id'),
				'POST_CATEGORY'=>3,
				'POST_ISACTIVE'=>1,
			);
			
			if($content_id) { // 0 => input baru
			
				if($content !=='') $this->gallery_m->__update('mdl_content', $post, array('POST_ID'=>$content_id));
				
				else {
					
					$this->gallery_m->__delete('mdl_content',  array('POST_ID'=>$content_id));
					$content_id = 0;
				}
				
			} else 
				if($content !=='') $content_id = $this->gallery_m->__insert('mdl_content', $post);
			
			$file_data = $this->upload->data();
			
			$img = array(
				'GALL_ID'=>$gall_id,
				'GALL_PIC_ID'=>$pic_id,
				'GALL_PIC_NAME'=>$name,
				'GALL_PIC_URI'=>to_uri($name),
				'GALL_PIC_PATH'=>$file_data['orig_name'],
				'GALL_PIC_DESC'=>$desc,
				'GALL_PIC_DEFAULT'=>$main,
				'POST_ID'=>$content_id
			);
			
			$this->gallery_m->simpan_img($img);
		
		}
		//dump_exit($this->gallery_m->__last_query());
		redirect(base_url().'admin/gallery/detail/'.$gall_id);
	}
	
	/**
	 * delete pic nya
	 * @param unknown_type $_id
	 */
	public function delete_img($_id_gall,$_id){
		$this->gallery_m->delete_img(false, $_id);
		redirect(base_url().'admin/gallery/detail/'.$_id_gall);
	}
	
	public function delete_gall($_id){
		$this->gallery_m->delete_img($_id, false);
		redirect(base_url().'admin/gallery/');
	}
	
	public function get_link_content(){
		//return $this->gallery_m->__select('mdl_content', 'POST_ID id, POST_TITLE title', array('POST_CATEGORY'=> 8));
		$e = $this->gallery_m->get_option_template();
		//dump($e);
		echo json_encode($e);
	}
	
	public function load_content($_id = false, $echo = true){
		
		$content = $this->gallery_m->__select('mdl_content', 'POST_CONTENT content', array('POST_ID'=> $_id), false)->content;
		
		if($echo) echo $content;
		
		else return $content;
	}
}
