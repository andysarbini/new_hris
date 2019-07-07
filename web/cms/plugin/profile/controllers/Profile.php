<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends GW_User {

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("profile_m");
		
		$this->load->model('bluehrd/bluehrd_user_m');
		
		$this->load->helper('cuti/cuti');
	}
	
	function index(){		
		
		/*
		
		$data["user"]	= $this->bluehrd_user_m->get_user(get_session('user_id'));

		$data["title"] 	= $data["user"]->nama_lengkap ;

		$this->masterpage->addContentPage("view_profile", 'contentmain', $data);

		$this->masterpage->show( );
		*/
		$this->view(get_session('user_id')); 
	}
	
	function save(){
		
		$_w["usr_id"] = get_session('user_id');
		
		// if password ganti
		
		$_pass = $this->input->post("usr_pass");
		
		if($_pass != "") {
		
			$this->load->helper("user/user");
		
			$_u["USR_PASS"] = gen_user_pass($_pass);
		
			$this->profile_m->__update("mdl_user", $_u, $_w);
		}
		
		// if ada upload image
		
		$rule_upload['upload_path']   = 'uploads/profile/';
		
		$rule_upload['allowed_types'] = 'gif|jpg|png|jpeg';
		
		$rule_upload['encrypt_name']  = true;
		
		$this->load->library('upload',$rule_upload);
		
		if($this->upload->do_upload('picture')){
		
			$file_data = $this->upload->data();
		
			$_d['profile_picture'] = $file_data['file_name'];
		} 
		
		// and other data
		
		$_d["nama_lengkap"] 	= $this->input->post("nama_lengkap");
		
		$_d["email_corporate"] 	= $this->input->post("email_corporate");
		
		$_d["tgl_lahir"]		= $this->input->post("tgl_lahir");
		
		$this->bluehrd_user_m->__update("mdl_user_data", $_d, $_w);
		
		redirect(base_url()."profile");	
	}
	
	function edit(){
		
		$data['include_script'] = inc_script(
		
			array(
		
				"cms/plugin/profile/js/profile.js"
			)
		);
		
		$data["user"]	= $this->bluehrd_user_m->get_user(get_session('user_id'));

		$data["title"] 	= $data["user"]->nama_lengkap ;
		
		$this->masterpage->addContentPage("form_profile", 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($usr_id){
		
		$data["user"]	= $this->bluehrd_user_m->get_user($usr_id);

		$data["title"] 	= $data["user"]->nama_lengkap ;
		
		$data["id_pengunjung"] =  get_session('user_id');

		$data['breadcrumb_active'] = $data['title'];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage("view_profile", 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function get($_p){
		
		$_s = $this->bluehrd_user_m->get_user($_p);		
		
		echo json_encode($_s);
	}
}
