<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * halaman ini user login menggunakan user dan pass
 * 
 */ 
	 
class admin extends GW_Admin {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('group_m');
	 }
	 
	
	function index(){
		$this->view();
	}
	
	function view(){
		$data['title'] = 'All Group';
		
		$data['group'] = $this->group_m->__select('mdl_user_group', 'USR_GRP_ID id, USR_GRP_NAME name, USR_GRP_DESC ket, USR_GRP_ACCESS acc');
		
		$this->masterpage->addContentPage('group_list', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function add_edit($_id=false){
		$data['title'] = 'Add Edit Group';
		
		if($_id) $data['group'] = $this->group_m->__select('mdl_user_group', 'USR_GRP_ID id, USR_GRP_NAME name, USR_GRP_DESC ket,USR_GRP_ACCESS acc', array('USR_GRP_ID'=>$_id), false);
		
		$this->masterpage->addContentPage('group_form', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function simpan(){
		
		$_id = $this->input->post('id');
		
		$_name = $this->input->post('name');
		
		$_ket = $this->input->post('ket');
		
		$_acc = $this->input->post('acc');
		
		$data = array(
		
			'USR_GRP_ID'=>$_id,
		
			'USR_GRP_NAME'=>$_name,
			
			'USR_GRP_DESC'=>$_ket,
		
			'USR_GRP_ACCESS'=>$_acc
		);
		
		$success = $_id ? $this->group_m->__update('mdl_user_group', $data, array('USR_GRP_ID'=>$_id)) : $this->group_m->__insert('mdl_user_group', $data);
		
		if($success) redirect(base_url().'admin/group/view');
		
		else die('error writing to database');
	}
	
	function hapus($_id = false){
		
		$this->group_m->__delete('mdl_user_group', array('USR_GRP_ID'=> $_id));
		
		redirect(base_url().'admin/group');
	}
}
