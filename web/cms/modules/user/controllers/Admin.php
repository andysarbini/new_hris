<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends GW_Admin {
	
	function __construct(){
		parent::__construct();
	
		$this->load->model('user_m');
	}
	
	function index(){
		
		$this->view();
	}
	
	function add_edit($_id = false){
		
		$data['title'] = 'User Manage Admin';
		
		if($_id) $data['user'] = $this->user_m->__select('vw_mdl_user', 'USR_ID id, USR_NAME nama, USR_EMAIL email, USR_GRP_ID group_id, USR_REF ref, USR_ACCESS acc', array('USR_ID'=>$_id), false);
		
		$this->masterpage->addContentPage('add_edit_form', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function view($_id = false){
		
		$data['title'] = 'User Manage Admin';
		
		$data['user'] =  $this->user_m->__select('vw_mdl_user', 'USR_ID id, USR_NAME nama, USR_EMAIL email, USR_GRP_NAME group_name, USR_ACCESS acc');
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function simpan(){
		
		$data = array(
			'USR_NAME'=>$this->input->post('nama'),
			'USR_EMAIL'=>$this->input->post('email'),
			'USR_ACCESS'=>$this->input->post('acc'),
			'USR_GRP_ID'=>$this->input->post('group_id')
		);
		
		if($this->input->post('pass')) {
			
			$this->load->helper('user');
			
			$data['USR_PASS'] = gen_user_pass($this->input->post('pass'));
		}
		
		if( $_id = $this->input->post('id') ) {
			
			$data['USR_ID'] = $_id;
			
			$this->user_m->__update('mdl_user', $data, array('USR_ID'=>$_id));
		} else 
			$this->user_m->__insert('mdl_user', $data);
		
		redirect(base_url().'admin/user');
	}
	
	function hapus($_id = false){
		
		$this->user_m->__delete('mdl_user', array('USR_ID'=>$_id)) ?
		
		redirect(base_url().'admin/user') : die('error cannot delete user '.$_id);
	}
	
	function check_existing_username(){
		
		$name = strtolower($this->input->post('name'));
		
		$id = $this->input->post('id') ? ' and USR_ID <>'.$this->input->post('id') : ''; 
		
		$a = $this->user_m->__query("select * from mdl_user where USR_NAME='$name' $id ");

		echo json_encode(count($a));
	}
}
