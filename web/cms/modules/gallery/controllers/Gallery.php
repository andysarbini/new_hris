<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends GW_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('gallery_m');
		$this->load->helper('image');
	}
	
	
	public function select($_id=0){
		$data['options'] = $this->gallery_m->view();
		$data['selected'] = $_id;
		return $this->load->view('select',$data); 
	}
	
	public function index(){
		$this->view();
	}
	
	/**
	 * interface gallery
	 * draw gallery
	 */
	public function view($_id_uri = 1, $template = 'carousel'){
		
		$this->config->load('gallery');
		
		$data['pic_path'] = base_url().Modules::run('api/options','mdl_gallery_upload_path');
		
		$tmp = $this->gallery_m->get_gallery_info($_id_uri)->template;
		
		$data['mdl'] = $this->gallery_m->get_gallery_pic($_id_uri);
		
		echo $this->load->view('templates/'.($tmp ? $tmp : $template),$data);
	}
	
}
