<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends GW_Admin
{
	function __construct(){
		parent::__construct();		
		$this->load->model("att_m");
	}
	
	/**
	 * tampilkan list user yg sudah diinput
	 * input param berdasarkan tanggal
	 */
	function index(){
		
		$data['include_script'] = inc_script(
		
			array(
			
				"includes/datepicker/bootstrap-datepicker.js",
				
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
				
			#	"includes/jquery-timepicker/jquery.timepicker.min.js",
				
			#	"includes/jquery-timepicker/jquery.timepicker.min.css",
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
		
				"cms/plugin/attendance/js/admin.js",
			)
		); 
		
		$this->load->helper("cuti/cuti");
		
		$data['date']	= @if_empty($this->input->get('date'), date("d-m-Y"));
		
		$data['title'] 	= "Daftar Kehadiran";		
		
		$data['tables']	= $this->att_m->get_list_attendance(bbdate($data['date']));
		
		$data['status'] = Modules::run('api/options','bb_opt_status_attendance');
		
		$this->masterpage->addContentPage('user_form', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function form($att_id = 0){
		
		$_p['att_id'] 	= $att_id;
		
		$att = $this->att_m->get_single_attendance(null,null,$_p);
		
		//$this->load->view("modal_form", $data); 
		
		echo json_encode($att);
	}
/*
	function user($usr_id = null, $year = null, $month = null){

		$data["year"] 	= @if_empty(getVar("year")) ? getVar("year") : date("Y");

		$data["month"] 	= @if_empty(getVar("month")) ? getVar("month") : date("n");

		$data["usr_id"] = $usr_id;

		$this->load->model("bluehrd/bluehrd_user_m");

		$data["data_user"] = $this->bluehrd_user_m->get_user($data["usr_id"]);

		$data["title"] 	= "Administrator Page Attendance";

		$data['include_script'] = inc_script(
			
			array(
				
				"cms/plugin/attendance/js/att.js",
				
				"cms/plugin/attendance/css/calender.css",
			)
		);
		
		$data['months']	= json_decode(Modules::run('api/options','bb_opt_bulan'), true);

		$this->load->model("cuti/cuti_m");

		$data["min_year"] = $this->cuti_m->get_lowest_year($data["usr_id"]);

		$data["max_year"] = date("Y") + 1;
		
		$this->load->helper("attendance");

		$data["att"]	= att_to_array($this->att_m->get_attendance($data["usr_id"], $data["year"], $data["month"]));

		$this->masterpage->addContentPage('user_form', 'contentmain', $data);

		$this->masterpage->show( );
	}
*/
	
	function save(){
		
		$this->load->helper("cuti/cuti");
		
		$_w = array();
		
		$_w['att_id'] = $this->input->post('att_id');

		$_d = array();
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		#$_d['usr_id'] 	= $this->bluehrd_user_m->get_user(array("nip"=>$this->input->post("nip")))->usr_id;
		$_d['nip'] 		= $this->input->post("nip");
		
		$_jam_in 		= count(explode(":",$this->input->post('jam_in'))) == 3 ? "":":00";
		
		#$_d['time_in']	= bbdate($this->input->post('tgl_in'))." ".$this->input->post('jam_in').$_jam_in;
		
		$_jam_out 		= count(explode(":",$this->input->post('jam_out'))) == 3 ? "":":00";
		
		#$_d['time_out']	= bbdate($this->input->post('tgl_out'))." ".$this->input->post('jam_out').$_jam_out;
		
		$_d['date_in']	= bbdate($this->input->post('tgl_in'));
		
		$_d['time_in']	= $this->input->post('jam_in').$_jam_in;
		
		$_d['date_out']	= bbdate($this->input->post('tgl_out'));
		
		$_d['time_out']	= $this->input->post('jam_out').$_jam_in;
		
		$_d['status'] 	= $this->input->post('status');
		
		#dump($_POST, 'POST');
		
		#dump_exit($_d, '_d');
		
		$_ = $_w['att_id'] ? $this->att_m->__update('mdl_attendance', $_d, $_w) : $this->att_m->__insert('mdl_attendance', $_d);
		
		//echo $_;
		
		redirect(base_url()."admin/attendance/?date=".$this->input->post('tgl_in'));
	}
	
	function delete($att_id){
		
		$_w['att_id'] = $att_id;
		
		echo $this->att_m->__delete('mdl_attendance', $_w);
	}
	
	function import_csv(){
		
		$config['upload_path']          = './uploads/attendance/';
        
        $config['allowed_types']        = 'csv|txt|zip';
		
		$this->load->library('upload', $config);
		
		if (  $this->upload->do_upload('document')){
			
			$_ud = $this->upload->data();
			
			$path_csv = $_ud['full_path'];
			
		} else {
			dump($_FILES);
			die($this->upload->display_errors());
		}
		
		// https://www.sitepoint.com/community/t/spliting-a-75mb-csv-into-managable-file-sizes/70486/15
		// https://www.codeigniter.com/userguide2/database/active_record.html#insert_batch
		
		$header_first_line = @if_empty($this->input->post('header'),true);
		
		$csv = new SplFileObject($path_csv);
		
		$csv->setFlags(SplFileObject::READ_CSV);
		
		$start = $header_first_line ? 1 : 0;
		
		$batch = 200; // maximal 200 data per insert 
		
		$counter = 1;
		
		$header_counter = array();
		
		$this->load->helper("attendance");
		$this->load->helper("cuti/cuti");
		
		while (!$csv->eof()) {
		
			$data = array();
			
			foreach(new LimitIterator($csv, $start, $batch) as $num =>$_l) {
				
				if(!is_array($_l) || $_l[0] == '') break;
				
				$_chead = array(
					"nip"		=> $_l[0],
					"date_in"	=> bbdate($_l[2]), 
					"time_in"	=> time_attendance($_l[3]), 
					"time_out"	=> time_attendance($_l[4]), 
					"status"	=> strtoupper($_l[5])
				);
			
				$data[$num] = $_chead;
			}
			
			if(count($data)) $this->att_m->insert_batch($data);
			
			unset($data);
			
			$start += $batch;
		
			$counter++;
		}
		
		redirect(base_url()."admin/attendance");
		
	}
	/*
		table revisi
	*/
	function revisi(){

		$data = array('title'=>'Revisi Absensi');
		
		$data['include_script'] = inc_script(
		
			array(
			
			#	"includes/datepicker/bootstrap-datepicker.js",
				
			#	"includes/datepicker/locales/bootstrap-datepicker.id.js",
			
				"includes/datatables/jquery.dataTables.min.js",
		
				"includes/datatables/jquery.dataTables.min.css",
		
				"cms/plugin/attendance/js/admin_revisi.js",
			)
		); 

		$_w = array(
			'YEAR(date_from)'	=> @if_empty($_GET['year']) ? (int)$this->input->get('year') : (int)date('Y'),
			'MONTH(date_from)'=> @if_empty($_GET['month']) ? (int)$this->input->get('month') : (int)date('n'),
			'closed_status'		=> @if_empty($_GET['closed_status']) ? $this->input->get('closed_status') : 0,
			'is_delete'			=> 0
		);

		if(isset($_GET['rev_type_id']) && $_GET['rev_type_id'] != '0') 	$_w['rev_type_id'] = $this->input->get('rev_type_id');
		 

		$this->load->config('attendance');

		$rule_upload = $this->config->item('revisi_uploads');

		$data['upload_path'] = $rule_upload['upload_path'];

		$data['month']	= @if_empty($this->input->get('month'), date('n'));

		$data['year']	= @if_empty($this->input->get('year'), date('Y'));

		$_year = $this->att_m->__select('mdl_attendance_revisi', "MIN(YEAR(date_from)) min", array(), false);
		
		$data["min_year"] = @if_empty($_year->min, date("Y"));
		
		$data["max_year"] = date("Y") + 1;

		$data['revs'] = $this->att_m->admin_get_list_revisi($_w);

		$this->masterpage->addContentPage('admin_revisi_table', 'contentmain', $data);

		$this->masterpage->show( );
	}

	function revisi_form($_rev_id){

		$data['include_script'] = inc_script(
		
			array(
			
				"cms/plugin/attendance/js/admin_revisi_form.js",
			)
		); 

		$data['title'] = "Form Revisi Admin";

		$_w = array('rev_id'=>$_rev_id);

		$rule_upload = $this->config->item('revisi_uploads');

		$data['upload_path'] = $rule_upload['upload_path'];

		$data['rev'] = $this->att_m->admin_get_list_revisi($_w);

		$this->masterpage->addContentPage('admin_revisi_form', 'contentmain', $data);

		$this->masterpage->show( );
	}

	function revisi_simpan(){

		$this->load->helper('attendance');

		$_w['rev_id'] = $this->input->post('rev_id');

		$data = array(
			'closed_date' 	=> implode(' ', get_now_time()), 
			'closed_usr_id' => get_session('user_id'),
			'closed_status' => $this->input->post('closed_status'),
			'closed_msg'	=> $this->input->post('closed_msg')
		);

		$this->att_m->__update('mdl_attendance_revisi', $data, $_w);

		redirect(base_url()."attendance/admin/revisi");
	}

	function load_attendance_list($_usr_id, $_year, $_month){
		
		$_w = array(
			'usr_id' => $_usr_id,
			'YEAR(date_in)' => (int)$_year,
			'MONTH(date_in)'=> (int)$_month
		);

		$atts = $this->att_m->__select('mdl_attendance', '*', $_w);
		debug($atts, '$atts');
		$_attendance = array();
		
		foreach($atts as $_var=>$_) $_attendance[$_->date_in] = array('att_id'=>$_->att_id,'status'=>$_->status,'time_in'=>$_->time_in, 'time_out'=>$_->time_out);
		debug($_attendance, '$_attendance');
		$this->load->helper('calender');

		$status = json_decode(mdl_opt('bb_opt_tipe_revisi'), true);

		echo build_html_calendar_vertical_admin($_attendance, $_year, $_month, $status);

	}

	function revisi_simpan_ubah_status(){

		$_data = array(
			'date_in' 	=> $this->input->post('date_in'),
			'rev_id'	=> $this->input->post('rev_id'),
			'status'	=> $this->input->post('status'),
			'usr_id'	=> $this->input->post('usr_id'),
			'time_in'	=> '00:00:03',
			'lat_in'	=> 0,
			'lon_in'	=> 0
		);

		$_att_id = $this->input->post('att_id');

		if($_att_id) $a = $this->att_m->__update('mdl_attendance', $_data, array('att_id'=>$_att_id));
		
		else $a = $this->att_m->__insert('mdl_attendance', $_data);
		
		if($a) $msg = array('status'=>'success', 'message'=>'Berhasil Mengubah Absensi');

		else $msg = array('status'=>'error', 'message'=>'Gagal Mengubah Absensi');

		echo json_encode($msg);
	}
	
}
