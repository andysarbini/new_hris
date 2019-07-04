<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * member admin what ?
 * add/edit member
 * login
 * recovery password
 * 
 */ 


class admin extends GW_Admin {
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('member_m');
	}
	
	function index(){
		
		$this->member();
	}
	
	function member($_id = false){
		
		$data['title'] = 'Member Page';
		
		$data['member'] = $this->member_m->load($_id);
		
		if($_id) 
			$this->masterpage->addContentPage('member_detail', 'contentmain', $data);
		
		else
			$this->masterpage->addContentPage('member_list', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	
	function add_edit($_id = false) {
		
		$data['title'] = 'Manage Member';
		
		if( $_id ) $data['member'] = $this->member_m->load($_id);
		
		$this->masterpage->addContentPage('member_form', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	
	function simpan(){
		
		$data = array(
		
			'MRD_ID' 	=> $this->input->post('id'),
			'MRD_NAME' 	=> $this->input->post('name'),
			'MRD_EMAIL' => $this->input->post('email'),
			'MRD_SEX' 	=> $this->input->post('sex'),
			'MRD_BIRTDAY' => $this->input->post('tgl'),
			'MRD_ADDR' 	=> $this->input->post('addr'),
			'MRD_ISACTIVE'=> $this->input->post('active')
		
		);
		//die(var_dump($data));
		$img = array();
		
		// upload
		
		$config['upload_path'] = 'uploads/members/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= 1024; // 1MB
		
		$this->load->library('upload', $config);
		// -- NEED FIXED
		if ( $this->upload->do_upload('pic') ) // yes pict
		{	
			$pic = $this->upload->data();
			
			// resize
			
			$this->load->library('image');
			
			$config['source_image'] = $pic['full_path'];
			$config['width'] = 120;
			$config['height'] = 120;

			$this->image->resize($config);
			
			// data img
			$img = array(
			
				'MRD_PIC'=>$pic['file_name'], 
				'MRD_PIC_RAW'=>$pic['raw_name'],
				'MRD_PIC_EXT'=>$pic['file_ext']
				
			);
			
			$data = array_merge($data, $img);
		
		}
		
		if( $data['MRD_ID'] ) {
		
			$this->member_m->__update('mdl_user', array('USR_ACCESS'=>$data['MRD_ISACTIVE']), array('USR_EMAIL'=>$data['MRD_EMAIL']));
			
			$result = $this->member_m->__update('mdl_portal_member', $data, array('MRD_ID'=>$data['MRD_ID'])); 
		}
		
		else {
			
			$data['MRD_ID'] = Modules::run('user/generate_md5', gen_pass() );
			
			$this->member_m->__insert('mdl_portal_member', $data);
			
			$this->member_m->__insert('mdl_user', array('USR_NAME'=>$data['MRD_NAME'], 'USR_EMAIL'=>$data['MRD_EMAIL'], 'USR_REF'=>$data['MRD_ID'],'USR_PASS'=>$data['MRD_ID'], 'USR_GRP_ID'=>3, 'USR_ACCESS'=>$data['MRD_ISACTIVE']));
		}
		
		redirect(base_url().'admin/member');
	}
	
	function hapus($_id){
		
		$this->member_m->__delete('mdl_portal_member', array('MRD_ID'=>$_id));
		
		redirect(base_url().'admin/member');
	}
	
	function change_pass(){
		
		$email = $this->input->post('email');
		$pass = $this->input->post('pass-login');
		$repass = $this->input->post('repass-login');
		$group_id = $this->input->post('group_id');
		
		if($pass === $repass) {
			 
			$pass = Modules::run('user/generate_md5',$pass);
			
			$feedback =  $this->member_m->__update('mdl_user', array('USR_PASS'=>$pass), array('USR_EMAIL'=>$email));
		} else {
			
			$feedback = 'password not match';
		}
		
		$this->member_m->__update('mdl_user', array('USR_GRP_ID'=>$group_id),array('USR_EMAIL'=>$email));
		
		if($this->input->post('json') ) echo $feedback;
		
		else  return $feedback ;
	}
	
}
