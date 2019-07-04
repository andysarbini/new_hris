<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * update opt khusus bb
 */
class Admin extends GW_Admin {

	function __construct(){

		parent::__construct();

		$this->load->model("opt_m");
	}

	function index(){

		// include third library
		$data['include_script'] = inc_script(

			array(

				// "includes/datatables/jquery.dataTables.min.css",

				"includes/datatables/jquery.dataTables.min.js",

				"cms/modules/options/js/admin_list.js"
			)
		);

		$data["title"]	= "Option List";

		$_p = @if_empty($this->input->get("key"), "opt_");

		$data["opts"]	= $this->opt_m->search_options($_p);

		$this->masterpage->addContentPage("admin_opt_list", 'contentmain', $data);

		$this->masterpage->show( );
	}

	/**
	 * 
	 * bisa di teruskan dengan 
	 * array_1 : array dimensi 1
	 * array_2 : array dimensi 2
	 * textarea
	 */ 
	function form($opt_id_key = null, $view="array_2"){

		$data['title'] = $opt_id_key;

		$data['include_script'] = inc_script(

			array(

				"cms/modules/options/js/admin_form.js",
			)
		);

		if($opt_id_key != null){

			if(is_numeric($opt_id_key) ) $_w["OPT_ID"] = $opt_id_key;

			else $_w["OPT"] = $opt_id_key;

			$data["opt"] = $this->opt_m->__select("mdl_options", "*", $_w, false);
		}
		
		$this->masterpage->addContentPage($view, 'contentmain', $data);

		$this->masterpage->show( );
	}

	function save(){

		$_w['OPT_ID'] 	= $this->input->post("OPT_ID");

		$_p['OPT']		= $this->input->post("OPT");

		$_p['OPT_KET']	= $this->input->post("OPT_KET");

		$_var 			= $this->input->post("var");

		$_val 			= $this->input->post("val");

		$_				= array();

		for($i = 0; $i < count($_var); $i++) $_[$_var[$i]]	= $_val[$i];

		$_p['OPT_VAL'] = json_encode($_);

		#dump($_p);
		#dump_exit($_w);

		if($_w['OPT_ID'] != 0) $this->opt_m->__update("mdl_options", $_p, $_w);
		#if($_p['OPT_ID'] != 0) echo "do update";
		else $this->opt_m->__insert("mdl_options", $_p);
		#else echo "do insert";
		redirect(base_url()."admin/options?s=bb_opt_");
	}

	function delete($id=null){

		if(!$id) die();

		echo $this->opt_m->__delete('mdl_options', array('OPT_ID'=>$id));
	}
}
