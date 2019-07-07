<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author g3n1k
 * custom dari class gallery
 */
class custom extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('gallery_m');
	}
	
	public function gall_img($_id=false){
		return $this->gallery_m->view_image($_id); 
	}
	
	public function get_path(){
		$this->load->config('gallery');
		return base_url().$this->config->item('mdl_gallery_upload_path');
	}
	
	public function test($_id = false){
		
		$img = $this->gallery_m->view_image($_id);
		
		$path = $this->get_path();
		
		foreach($img as $var){
			echo '<img src="'.$path.'/'.$var->path.'" />';
		}
		
		dump($img);
	}
	
}
