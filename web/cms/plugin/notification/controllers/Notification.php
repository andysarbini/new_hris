<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends GW_User
{
	function __construct(){
		parent::__construct();
		$this->load->model("notif_m");
	}

	// list halaman notification 
	function index(){

		$data["title"] = "Notifikasi";

		$data['include_script'] = inc_script(
			array(
				"cms/plugin/notification/js/notif.js"
			)
		);
	
		$this->masterpage->addContentPage('allnotif', 'contentmain', $data);

		$this->masterpage->show( );
	}

	// interface ajax get notification by page
	function get($page = 0){
	
		$data["notifs"] 	= $this->notif_m->get_list_notif( get_session("user_id"), $page * 10 );
		
		$this->load->view("notif_json", $data);
	}

	// get how much notif which not read or what
	function num(){
		
		echo $this->notif_m->get_num_notif(get_session("user_id"));
	}

	// interface notification
	function set($data = null){

		if(is_array($data)) return $this->notif_m->__insert("mdl_notif", $data);
	}

	// set kalo sudah di read
	function read($notif_id = null){
	
		if($notif_id) {
			
			$usr_id = get_session("user_id");
			
			$_notif_data = $this->notif_m->__select("mdl_notif","*", array("usr_id"=>$usr_id, "notif_id"=>$notif_id),false);
			
			if(count($_notif_data) ) {
				
				$this->notif_m->__update("mdl_notif", array("status"=>0), array("notif_id"=>$notif_id, "usr_id"=>$usr_id));

				redirect($_notif_data->url);
			} 
			
			else page_404();
		}
		
		else page_404();
	}
	
	function set_status(){
		
		$_w['notif_id'] = $this->input->post('notif_id');
		
		$_p['status']	= $this->input->post('status');
		
		$_w['usr_id'] 	= get_session("user_id");
		
		$this->notif_m->__update('mdl_notif', $_p, $_w);
	}
}
