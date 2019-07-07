<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	var $usr_id = 0;

	var $group_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("cuti_m");

		$this->usr_id       = get_session("user_id");

		$this->group_id   = get_session("group_id");
		
	}

	function index(){
		
	}

/*
	function index($year = null, $status=null){
		// ADMIN = 2
		if($this->group_id != 2) die($this->group_id  . " not admin");

		$data['include_script'] = inc_script(
			array(
				"cms/plugin/cuti/js/admin.js",
			)
		);

		$data["title"]      = "Administrasi Cuti";

		$data["hightlight"] = $this->input->get("hightlight");

		$data["status"]     = $status != null  ? $status : 1;

		$data["lowest_year"] = $this->cuti_m->get_lowest_year();

		$data["slc_year"]	= $year != null ? $year : date("Y"); 

		$data["list_cuti"]  = $this->cuti_m->admin_get_list($data["status"]);

		// jika dia admin
		$this->masterpage->addContentPage('admin', 'contentmain', $data);

		$this->masterpage->show( );
	}
/**/
	function listcuti($year=null, $status = null){
		
		if(!$status) $status = getVar("status");
		
		if(!$year) 	$year = getVar("year");

		$list = $this->cuti_m->admin_get_list($year, $status);

		echo json_encode($list);
	}

	function setstatus(){

		$cuti_id    = $this->input->post("cuti_id");

		$status    	= $this->input->post("status");
		
		$result	= 0;

		if($this->group_id == 2) {
			
			$result = $this->cuti_m->__update("mdl_cuti", array("status"=>$status),array("cuti_id"=>$cuti_id));

			if($result != 0 || $result != "0" ) {

				$cuti = $this->cuti_m->__select("mdl_cuti", "*", array("cuti_id"=>$cuti_id), false);
				
				$_status = array("Di Tolak", "Menunggu", "Di terima");

				$_notif["usr_id"] = $cuti->usr_id;

				$_notif["title"] = "Pengajuan cuti, tanggal " .$cuti->tgl_from  . " s/d " . $cuti->tgl_to . " status " . $_status[$status];
	
				$_notif["url"]	= base_url()."cuti/?highlight=".$result;
	
				Modules::run("notification/set", $_notif);/** */
				
				
				// if status cuti di terima, set status attendance ke cuti 
				
				if($status==2) $this->set_status_cuti($cuti->usr_id, $cuti->tgl_from, $cuti->tgl_to);
			}
		}
		echo $result;
	}
	
	function set_status_cuti($usr_id, $tgl_from, $tgl_to){
	//function set_status_cuti(){
		
		//$tgl_from = '2010-10-01';
		//$tgl_to = '2010-10-05';  // untuk mysql
		
		// add 1 day in tgl_to // debug for php

		$date = new DateTime($tgl_to);
		$date->modify('+1 day');
		$tgl_to_1 = $date->format('Y-m-d') . "\n";
		
		// get date betwen 2 date
				
		$period = new DatePeriod(
			new DateTime($tgl_from),
			new DateInterval('P1D'),
			new DateTime($tgl_to_1)  // untuk php
		);
		
		$_date_cuti = array();
		
		foreach ($period as $key => $value) $_date_cuti[] = $value->format('Y-m-d') ;      
		
		// set attendance
		$this->load->model('attendance/att_m');
		$this->att_m->set_status_cuti($usr_id, $_date_cuti);		
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
		
		redirect(base_url()."cuti/admin/type/");
	}
	
	function type_cuti_delete($type_id=null){
		
		if(!$type_id) die();
		
		echo $this->cuti_m->__delete('mdl_cuti_type', array('type_id'=>$type_id));
	}
	
	
}
