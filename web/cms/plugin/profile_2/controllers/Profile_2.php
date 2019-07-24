<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_2 extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("addfile_m");

		$this->usr_id = get_session('user_id');
	}
	
	function index(){

		$data['include_script'] = inc_script(
			array(

				"cms/plugin/profile_2/js/jasny-bootstrap.min.js",
				"cms/plugin/profile_2/css/jasny-bootstrap.min.css",
			)
		);

		$_w = array(
			'usr_id' => get_session('user_id'),
		);



		$data['listkaryawan'] = $this->addfile_m->__select('mdl_user_files', '*', array_merge($_w));

		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('view_profile', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function save(){

		$file_id  = $this->input->post('file_id');

		$_data = array(
			'tipeberkas'	=> $this->input->post('tipeberkas'),
			'usr_id'		=> get_session('user_id'),
		);

		$this->load->config('fileupload_c');

		$rule_upload = $this->config->item('profilupload');
	
		$this->load->library('upload', $rule_upload);
		
		if ( $this->upload->do_upload('file')){
			
			$file_data = $this->upload->data();

			$_data['path_file '] = $file_data['file_name'];
		} 

		if($file_id) $this->addfile_m->__update('mdl_user_files', $_data, array('file_id'=>$file_id));

		else $this->addfile_m->__insert('mdl_user_files', $_data);

		redirect('profile_2');
	}
	
	
	function get($_p){
		
		$_s = $this->bluehrd_user_m->get_user($_p);		
		
		echo json_encode($_s);
	}

	// function form($file_id = false){

	// 	$data['include_script'] = inc_script(
	// 		array(
	// 			"includes/moment/moment.min.js",
	// 			"includes/datepicker/bootstrap-datepicker.js",
	// 			"includes/datepicker/locales/bootstrap-datepicker.id.js",
	// 			"cms/plugin/attendance/js/revisi_form.js",
	// 		)
	// 	);
		
		
		

	// 	if($file_id) $data['data'] = $this->addfile_m->__select('mdl_user_files', '*', array('file_id'=>$file_id),false);

	// 	$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
	// 	$this->masterpage->addContentPage('uploadfile_p', 'contentmain', $data);

	// 	$this->masterpage->show( );
	// }
}
