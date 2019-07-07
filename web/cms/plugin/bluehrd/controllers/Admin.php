<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends GW_Admin
{
	function __construct(){
		parent::__construct();
		$this->load->model('bbl_m');
		
		
	}
/*
	function index(){

		$data["title"] = "Administrator";

		$data['include_script'] = inc_script(
			array(
				"cms/plugins/bluehrd/js/admin.js",
			)
		);

		$this->masterpage->addContentPage('admin_dashboard', 'contentmain', $data);

		$this->masterpage->show( );
	}
	/**
	 * !Nama kategori belum bisa dinamis, seharusnya ikut kategori yang dibuat dari cms: LIMITLESS LEARNING!
	 * untuk mendapatkan "kategory" bblearning atau info
	 * show list berdasarkan 'category' berupa 'bblearning', 'info'
	 * dalam category ada input param berupa 'company','level','grade'
	 * 
	 */ 
	
	function index(){
		
		$this->bbl();
	}
	
	function bbl($category = 'bblearning'){
		
		$_w['category']	= $category;
		/*$content_id = @if_empty($this->input->get('content_id'),"");
		if(!empty($content_id)){
			$_w['content_id'] = $content_id;
		}*/
		$company = @if_empty($this->input->get('company'),"");
		if(!empty($company)){
			$_w['company'] = $company;
		}
		$jabatan = @if_empty($this->input->get('jabatan'),"");
		if(!empty($company)){
			$_w['jabatan'] = $jabatan;
		}
		/*$level	= @if_empty($this->input->get('level'), "");		
		if(!empty($company)){
			$_w['level'] = $level;
		}
		$grade	= @if_empty($this->input->get('grade'), "");
		if(!empty($grade)){
			$_w['grade'] = $grade;
		}*/
		
		$data = $_w;

		$obj_bbl = array();
		$obj_options = $this->bbl_m->get_content_bbl();
		if(!empty($obj_options)){
			foreach($obj_options as $v){
				$obj_bbl[] = (object) array('id' => $v->POST_ID, 'title' => $v->POST_TITLE); 
			}
		}

		$data['slc_bbl'] = $obj_bbl;

		$data['slc_company']= Modules::run("api/options", "bb_opt_company");
		
		$data['slc_company']= Modules::run("api/options", "bb_opt_company");

		$data['slc_jabatan']	= Modules::run("api/options", "bb_opt_jabatan");
		
		//$data['slc_level']	= Modules::run("api/options", "bb_opt_level");
		
		//$data['slc_grade']	= Modules::run("api/options", "bb_opt_grade");
		
		$data['title']	= "Content " . $_w['category'];	
		
		//echo "<pre>"; print_r($_w); die;
		
		$data['lists'] 	= $this->bbl_m->bbl_get_list($_w);
		
		$data['param']	= $_w;
		
		$data['include_script'] = inc_script(
		
			array(
		
				"includes/datatables/jquery.dataTables.min.js",
				"cms/plugin/bluehrd/js/admin_user.js",
				"cms/plugin/bluehrd/js/admin_bbl.js",
				//"includes/bluehrd/admin_bbl.js",
			)
		);			
		
		//echo "<pre>"; print_r($data); die;
		$this->masterpage->addContentPage('admin_bbl_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	/*
	function bbl_save(){
		
		$_d["category"] = $this->input->post("inp_category");

		$_d["content_id"] 	= $this->input->post("inp_content_id");

		$_d["jabatan"] 	= $this->input->post("inp_jabatan");
		
		$_d["company"] 	= $this->input->post("inp_company");
		
		//$_d["level"] 	= $this->input->post("inp_level");
		$_d["level"] = 0;
		
		//$_d["grade"] 	= $this->input->post("inp_grade");
		
		$_d["bbl_id"] 	= @if_empty($this->input->post("inp_bbl_id"), 0);
		//$_d["bbl_id"] = 0;
		
		//dump($_d); die;
		//if(empty($_d["bbl_id"]) || ($_d["bbl_id"] == "undefined")) unset($_d["bbl_id"]);
		/*if(@if_empty($_d["bbl_id"])){
			$this->bbl_m->bbl_save($_d);
			redirect(base_url()."bluehrd/admin/bbl");
		}else{
			$last_id = $this->bbl_m->bbl_save($_d);
			redirect(base_url()."admin/content/add?bbl_id=".$last_id);
		}* /
		$this->bbl_m->bbl_save($_d);
		redirect(base_url()."bluehrd/admin/bbl");
		
	}
	/**/
	
	function bbl_delete(){
		
		$content_id = $this->input->post("bbl_id");
		
		$this->bbl_m->__delete('mdl_bluehrd_bbl_role', array('content_id'=>$content_id));
		
		echo $this->bbl_m->__delete('mdl_content', array('POST_ID'=>$content_id, 'POST_CATEGORY'=>26));
	}

}
