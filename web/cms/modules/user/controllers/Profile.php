<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author g3n1k
 */
class profile extends GW_User {
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('user_m');
	}
	
	function index(){
	
		$this->user();
	}
	
	function user($type=null, $value=null){
		
		$_list_column = array('id'=>'USR_ID');
		// tampikan diri sendiri
		if($type == null) $_w['USR_ID'] = $this->session->userdata['user_id'];
			
		else $_w[$_list_column[$type]] = $value;
		
		$data['user'] = $this->user_m->__select('mdl_user', '*', $_w, false);
		
		$data['title'] = "Detail Profile User";
		
		$this->masterpage->addContentPage('user_detail', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	// tampilkan form untuk edit profile
	function form(){
		
		$_w['USR_ID'] = $this->session->userdata['user_id'];
		
		$data['title'] = "Ubah Profile User";
		
		$data['user'] = $this->user_m->__select('mdl_user', '*', $_w, false);
		
		$this->masterpage->addContentPage('profile_form', 'contentmain', $data);

		$this->masterpage->show( );
	}
	// interface menyimpan
	function save(){
		
		$this->load->helper('user');
		
		$_w['USR_ID'] 	= $this->session->userdata['user_id'];
		
		$_d['USR_NAME'] = $this->input->post('user');
		
		$_d['USR_EMAIL']= $this->input->post('email');
		
		$_pas1		= $this->input->post('pass');
		
		$_pas2		= $this->input->post('repass');
		
		if($_pas1 && $_pas1===$_pas2) $_d['USR_PASS'] = gen_user_pass($_pas1);
		
		$this->user_m->__update('mdl_user', $_d, $_w);
		
		redirect(base_url().'user/profile');
	}
}
