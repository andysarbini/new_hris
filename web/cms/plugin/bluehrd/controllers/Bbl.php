<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Bbl extends GW_User
{
	function __construct(){

		parent::__construct();

		$this->load->model("bluehrd_user_m");
		$this->load->model("bbl_m");
	}

	/**
	 * 
	 */ 
	function index($category='bblearning'){

		$data["title"] = strtoupper($category)." BlueBird";
/*
		$data['include_script'] = inc_script(

			array(

				"cms/plugins/bluehrd/js/bbl.js",
			)
		);
*/
		$user	= $this->bluehrd_user_m->get_user(get_session("user_id"));
		
		$_w = array("company"=>$user->company, "level"=>$user->level, "grade"=>$user->grade, "category"=>$category);
		
		$data["bbl"]	= $this->bbl_m->bbl_get_list($_w);

		$this->masterpage->addContentPage('user_bbl_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function v($bbl_id){
		
		$user	= $this->bluehrd_user_m->get_user(get_session("user_id"));
		
		$_w = array("company"=>$user->company, "level"=>$user->level, "grade"=>$user->grade, "bbl_id"=>$bbl_id);
		
		$data["bbl"]	= $this->bbl_m->bbl_get_content($_w);
		
		debug($data["bbl"]);
		
		$data["title"]	= $data["bbl"]->title;

		$this->masterpage->addContentPage('user_bbl_view', 'contentmain', $data);

		$this->masterpage->show( );
	}

	
}
