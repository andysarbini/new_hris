<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("slip_m");
	}

	// base_url()."cuti/admin/index/".?year=2018&month=7
	function index(){
		
		$this->load->model("cuti/cuti_m");
		
		// include third library
		$data['include_script'] = inc_script(
			
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/slipgaji/js/admin.js",
			)
		);
		
		# set param
		$_w = array();
		
		$_w['year'] 	= @if_empty($this->input->get('year'),date("Y"));
		 
		$_w['month'] 	= @if_empty((int)$this->input->get('month'),date("n")); 
		
		# get data table
		
		$data['tables'] = $this->slip_m->get_list_slip($_w);
		
		# get year and month
		
		$data['bulan']	= json_decode(Modules::run('api/options','bb_opt_bulan'), true);
		
		$data['lowest_year'] = $this->cuti_m->get_lowest_year(null, 'mdl_slipgaji','tahun');
		
		# set variable
		
		$data['title']	= 'Slip Gaji' ;
		
		$data['year']	= $_w['year'] ;
		
		$data['month']	= $_w['month'] ;
		
		# load helper
		
		$this->load->helper('cuti/cuti');
		
		# show to template
		
		$this->masterpage->addContentPage('admin_list_slip', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function save(){
		
		$_u["nip"] = strtoupper($this->input->post("nip"));
		
		$this->load->model("bluehrd/bluehrd_user_m");
		
		$_ = $this->bluehrd_user_m->get_user($_u);
		
		if(!@if_empty($_->usr_id)) die("NIP yang dimasukan salah");
		
		$_p["usr_id"] = $_->usr_id;
		
		$_p["tahun"] = $this->input->post("tahun");
		
		$_p["bulan"] = $this->input->post("bulan");
		
		$_p["summary"] = $this->input->post("summary");
		
		$_p["status"]= $this->input->post("status");
		
		# if upload file 
		
		$config['upload_path']          = './uploads/slip/';
        
        $config['allowed_types']        = 'pdf|docx|doc|xls|xlsx';
		
		$config['file_name'] 			= $_u["nip"]."_".$_p["tahun"]."_".$_p["bulan"];
		
		$this->load->library('upload', $config);
		
		if (  $this->upload->do_upload('document')){
			
			$_ud = $this->upload->data();
			
			$_p["document"] = $_ud['file_name'];
		}
				
		#else { dump($this->upload->display_errors()); }
		
		#dump($_p);
		
		$this->slip_m->__insert('mdl_slipgaji', $_p);
		
		redirect(base_url()."admin/slipgaji/?year=".$_p["tahun"]."&month=".$_p["bulan"]);
	}
	
	function detail($slip_id){
		
		$data['bulan']	= json_decode(Modules::run('api/options','bb_opt_bulan'), true);
		
		$data['slip'] = $this->slip_m->get_slip(array('slip_id'=>$slip_id));
		
		$this->load->view('detail_slip', $data);
	}
	
	function delete($slip_id){
		
		echo $this->slip_m->__delete('mdl_slipgaji', array('slip_id'=>$slip_id));
	}
	
	/*
	function profile($id){
		
		$this->load->helper('cuti');
		
		$data['user'] = get_user(array('u.usr_id'=>$id));
		
		$this->load->view("profile_detail", $data);
	}
	
	function type(){
		
		$data['include_script'] = inc_script(
			array(
			
				"cms/plugin/cuti/js/admin_type.js",
			)
		);
		
		$data["title"]	= "Jenis Cuti";
		
		$data["types"] 	= $this->cuti_m->get_type_cuti();
		
		$this->masterpage->addContentPage('types_cuti', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function type_cuti($type_id = null){
		
		$data['type'] = $type_id ? $this->cuti_m->get_type_cuti($type_id) : array(); 
		
		$this->load->view('form_type_cuti', $data);
	}
	
	function type_cuti_save(){
		
		foreach($_POST as $var=>$v) $_w[$var] = $this->input->post($var);
		
		if($_w['type_id']) 	$this->cuti_m->__update('mdl_cuti_type', $_w, array('type_id'=>$_w['type_id']));
		
		else {
		
			unset($_w['type_id']);
		
			$this->cuti_m->__insert('mdl_cuti_type', $_w);
		}
		
		redirect(base_url()."admin/cuti/type/");
	}
	
	function type_cuti_delete($type_id=null){
		
		if(!$type_id) die();
		
		echo $this->cuti_m->__delete('mdl_cuti_type', array('type_id'=>$type_id));
	}
	/**/
}
