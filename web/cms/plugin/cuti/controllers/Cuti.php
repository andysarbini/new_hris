<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends GW_User {
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model("cuti_m");
		
		$this->load->helper("cuti");

		$this->usr_id = get_session("user_id");
		
	}
	
	function index(){

		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
		
				"includes/datepicker/bootstrap-datepicker.js",
				
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
				
				"cms/plugin/cuti/js/cuti.js",
			)
		);

		$data["slc_year"]	= isset($_GET["year"]) ? $this->input->get("year") : date("Y"); 

		$data["title"] 	= "Izin Cuti";

		$data["lowest_year"] = $this->cuti_m->get_lowest_year($this->usr_id);
		
		$data["types"]	= $this->cuti_m->get_type_cuti();
		
		$data["atasan"]	= $this->is_atasan();
		
		$this->load->helper('cuti');
		
		$data['tables'] = $this->cuti_m->get_list_cuti_year($this->usr_id, $data["slc_year"]);

		$data['breadcrumb_active'] = $data['title'];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	private function is_atasan(){
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_	= $this->bluehrd_user_m->get_user($this->usr_id);
		
		return $this->cuti_m->is_atasan($_->nip);
	}
	
	function detail($cuti_id){
		
		//$_w['usr_id'] = $this->usr_id;
		
		$_w['cuti_id']= $cuti_id;
		
		$data['cuti'] = $this->cuti_m->get_cuti($_w);
		
		$this->load->view('user_detail_cuti', $data);
	}
	
	function save(){
		
		$_p['tgl_from'] = bbdate($this->input->post('tgl_from'));
		
		$_p['tgl_to'] 	= bbdate($this->input->post('tgl_to'));
		
		$_p['usr_id'] 	= $this->usr_id;
		
		$_p['alasan']	= $this->input->post('alasan');
		
		$_p['type_id']	= $this->input->post('type_id');
		
		$_p['days']		= duration($_p['tgl_from'], $_p['tgl_to']);
		
		# if upload file 
		
		$config['upload_path']          = './uploads/cuti/';
        
        $config['allowed_types']        = 'pdf|docx|doc';
		
		$this->load->library('upload', $config);
		
		if (  $this->upload->do_upload('document')){
			
			$_ud = $this->upload->data();
			
			$_p['document'] = $_ud['file_name'];
		} 
		
		//else { dump($this->upload->display_errors()); }
		
		#dump($_p);
		
		$this->cuti_m->__insert('mdl_cuti', $_p);
		
		$this->notif_to_atasan($_p);
		
		redirect(base_url()."cuti");
	}
	
	function duration($tgl_from = null, $tgl_to = null){
		
		if($tgl_from && $tgl_to) echo duration(bbdate($tgl_from), bbdate($tgl_to));
	}
	
	private function notif_to_atasan($_p = array()){
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_  = $this->bluehrd_user_m->get_user($this->usr_id); // dapatkan nip atasan
		
		$_a = $this->bluehrd_user_m->get_user(array('nip'=>$_->atasan_nip)); // dapatkan data atasan		
		
		$_notif["usr_id"] = $_a->usr_id;

		$_notif["title"] = $_->nama_lengkap." mengajukan cuti, tanggal " .$_p['tgl_from']  . " s/d " . $_p['tgl_to'] ."(". $_p['days'] ." hari)";

		$_notif["url"]	= base_url()."cuti/persetujuan";

		Modules::run("notification/set", $_notif);				
	}
	
	private function notif_to_bawahan($_p = array()){
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_  = $this->cuti_m->get_cuti(array('cuti_id'=>$_p['cuti_id'])); // dapatkan nip usr_id	
		
		$_notif["usr_id"] = $_->usr_id;

		$_notif["title"] = "Pengajuan Cuti anda <b>di" .status($_p['status']) ."</b>";

		$_notif["url"]	= base_url()."cuti/";

		Modules::run("notification/set", $_notif);			
	}
	
	// halaman untuk menyetujui/menolak cuti yang di ajukan
	 
	function persetujuan(){
		
		$data['include_script'] = inc_script(
			
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/cuti/js/cuti_persetujuan.js",
			)
		);
		
		$data["slc_year"]	= isset($_GET["year"]) ? $this->input->get("year") : date("Y");
		
		$data["status"]		= isset($_GET["status"]) ? $this->input->get("status") : null;
		
		$data["atasan"]		= $this->is_atasan();
		
		if($data["status"]) $_w['status'] = $data['status'];
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_ = $this->bluehrd_user_m->get_user($this->usr_id); // dapatkan nip diri sendiri
		
		$_w['nip'] 	= $_->nip;
		
		$_w['year'] = $data['slc_year'];
		
		$data["lowest_year"] = $this->cuti_m->get_lowest_year($this->usr_id);
		
		$data['tables'] = $this->cuti_m->atasan_get_list_cuti_bawahan($_w);
		
		$this->masterpage->addContentPage('user_persetujuan', 'contentmain', $data);

		$this->masterpage->show( );		
	}
	
	function persetujuan_save(){
		
		$cuti_id = $this->input->post("cuti_id");
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_  = $this->bluehrd_user_m->get_user($this->usr_id); // dapatkan nip atasan
		//		die('habis get user');
		if($this->cuti_m->check_autority_persetujuan($cuti_id, $_->nip)) {
			
			$_w["cuti_id"] = $this->input->post("cuti_id");
		
			$_p["alasan_atasan"] = $this->input->post("alasan_atasan");
			
			$_p["status"] = $this->input->post("status");
			
			$this->cuti_m->__update("mdl_cuti", $_p, $_w);
			
			$_pb = array("cuti_id"=>$_w["cuti_id"], "status"=>$_p["status"]);
			
			$this->notif_to_bawahan($_pb);
		}
		
		redirect(base_url()."cuti/persetujuan");
	}
	
	function sisa($thn = null, $usr_id = null){
		
		if(!$usr_id) $usr_id = $this->usr_id;

		if(!$thn) $thn = date('Y');
		
		$_ = sisa_cuti($thn, $usr_id);
		
		if(isset($_GET['format'])) echo $_;
		
		else return $_;		
	}
}
