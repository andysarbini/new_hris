<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Revisi extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("att_m");

		$this->usr_id = get_session('user_id');
	}

	function index(){

		$data['include_script'] = inc_script(
			array(
				"includes/moment/moment.min.js",
				"includes/datepicker/bootstrap-datepicker.js",
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
				"cms/plugin/attendance/js/revisi_form.js",
			)
		);

		$_w = array(
			'usr_id' => get_session('user_id'),
			'is_delete' => 0
		);

		$data['month']	= @if_empty($this->input->get('month'), date('n'));

		$data['year']	= @if_empty($this->input->get('year'), date('Y'));

		$this->load->model("cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($this->usr_id, 'mdl_attendance', "YEAR(date_from)");

		$data["max_year"] = date("Y") + 1;	

		$data['revs'] = $this->att_m->__select('mdl_attendance_revisi', '*', array_merge($_w));

		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('revisi_table', 'contentmain', $data);

		$this->masterpage->show( );
	}

	function save(){

		$rev_id  = $this->input->post('rev_id');

		$_data = array(
			'date_from' 	=> $this->input->post('date_from'),
			'date_to' 		=> $this->input->post('date_to'),
			'rev_type_id' 	=> $this->input->post('rev_type_id'),
			'subjek'		=> $this->input->post('subjek'),
			'keterangan'	=> $this->input->post('keterangan'),
			'usr_id'		=> get_session('user_id'),
		);

		$this->load->config('attendance');

		$rule_upload = $this->config->item('revisi_uploads');
	
		$this->load->library('upload', $rule_upload);
		
		if ( $this->upload->do_upload('file')){
			
			$file_data = $this->upload->data();

			$_data['path_file '] = $file_data['file_name'];
		} 

		if($rev_id) $this->att_m->__update('mdl_attendance_revisi', $_data, array('rev_id'=>$rev_id));

		else $this->att_m->__insert('mdl_attendance_revisi', $_data);

		redirect('attendance/revisi');
	}

	function delete($_rev_id){
		
		$_w = array(
			'usr_id' => get_session('user_id'),
			'rev_id' => $_rev_id
		);
		
		$this->att_m->__update('mdl_attendance_revisi', array('is_delete'=>1),$_w);

		redirect('attendance/revisi');
	}

	function form($rev_id = false){

		$data['include_script'] = inc_script(
			array(
				"includes/moment/moment.min.js",
				"includes/datepicker/bootstrap-datepicker.js",
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
				"cms/plugin/attendance/js/revisi_form.js",
			)
		);

		if($rev_id) $data['data'] = $this->att_m->__select('mdl_attendance_revisi', '*', array('rev_id'=>$rev_id),false);

		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
	
		$this->masterpage->addContentPage('revisi_form', 'contentmain', $data);

		$this->masterpage->show( );
	}
}
