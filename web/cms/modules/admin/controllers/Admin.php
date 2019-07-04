<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * halaman ini user login menggunakan user dan pass
 * 
 */
 
class admin extends GW_Admin {
	 
	 public function __construct(){
		parent::__construct();
		if(get_option('str_open_admin') && !is_login()) if($this->uri->segment(2) != get_option('str_open_admin')) show_404();
		elseif(! is_login()) redirect(base_url().'login');
	 }
	 
	 public function index(){
		$data['title'] = 'Administrator Page';
	 	$this->masterpage->addContentPage('admin_page', 'contentmain', $data);
		$this->masterpage->show( );
	 }
 }
?>
