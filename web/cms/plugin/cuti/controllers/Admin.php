<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends GW_Admin {

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("cuti_m");
	}

	// base_url()."cuti/admin/index/".?year=2018&month=7
	function index(){
		
		// include third library
		$data['include_script'] = inc_script(
			
			array(
				
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/cuti/js/admin.js",
			)
		);
		
		# set param
		$_w = array();
		
		$_w['year'] 	= @if_empty($this->input->get('year'),date("Y"));
		 
		$_w['month'] 	= @if_empty((int)$this->input->get('month'),""); 
		
		# get data table
		
		$data['tables'] = $this->cuti_m->get_list_cuti($_w);
		
		# get year and month
		
		$data['bulan']	= json_decode(Modules::run('api/options','bb_opt_bulan'), true);
		
		$data['lowest_year'] = $this->cuti_m->get_lowest_year();
		
		# set variable
		
		$data['title']	= 'Daftar Cuti ' ;
		
		$data['year']	= $_w['year'] ;
		
		$data['month']	= $_w['month'] ;
		
		# load helper
		
		$this->load->helper('cuti');
		
		# show to template
		
		$this->masterpage->addContentPage('admin_list_cuti', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
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

	function delete_cuti($id=null){
		
		if(!$id) die();
		
		echo $this->cuti_m->__delete('mdl_cuti', array('cuti_id'=>$id));
	}
}
