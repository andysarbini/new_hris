<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends GW_Admin {
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('widget_m');
	}
	
	function index(){
		
		$data['title'] = 'Widget Admin';
		
		$data['tables'] = $this->widget_m->load_list_widget();
		
		$this->masterpage->addContentPage('admin', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function add_edit($_id_uri_widget=false){
		
		$data['title'] = 'Add - Edit Widget';
	 	
		$this->masterpage->addContentPage('form-widget', 'contentmain', $data);
	 	
		$this->masterpage->show( );
	}
	 
	function load_list_widget($_id=false){
		
		$_id = ($_id ? $_id: $this->input->post('id'));
		
		echo json_encode( $this->widget_m->load_list_widget($_id) );
	}
	
	/**
	 * get group
	 * loop get list pages
	 * send
	 */

	function load_list_page(){
		// i must load another library 
		$this->load->library('navigation/navigation_l_libraries');
		
		$list_page = array();
		
		$groups = $this->widget_m->get_group_navigation();
		
		foreach($groups as $g){

			$list_page[] = array('id'=>$g->id, 'title'=>$g->title, 'isgroup'=>1);
			
			$lists = $this->navigation_l_libraries->generate_array_menu($g->id);
			
			foreach($lists as $l){

				$list_page[] = array('id'=>$l['id'], 'title'=>$l['title']);
			}
		} 
		//print_r($list_page);
		echo json_encode($list_page);
	}
	
	function simpan(){
		
		$data = array(
			
			'WID_ID'=>$this->input->post('id'),
			
			'WID_TITLE'=>$this->input->post('title'),
			
			'WID_TITLE_SHOW'=>$this->input->post('title_show'),
			
			'WID_URI'=>$this->input->post('uri'),
			
			'WID_SCRIPT'=>$this->input->post('code'),
		
			'WID_ACTIVE'=>$this->input->post('active'),
		
			'WID_NAV'=>0			
		);
		
		dump($data);
		$pages = $this->input->post('pages');
		
		if( $data['WID_ID'] ) {
			
			$this->widget_m->__delete('mdl_widget_navigation_group', array('WID_ID'=>$data['WID_ID']));
			
			$this->widget_m->__delete('mdl_widget_navigation_list', array('WID_ID'=>$data['WID_ID']));
		}
				
		foreach($pages as $p){
			
			// all
			if('all' == $p){
				
				$data['WID_NAV'] = 1;
				
				break;
			}
			
			// group
			elseif(preg_match('/group_/', $p)) {
				
				$g = preg_split('/group_/', $p);
				
				$this->widget_m->__insert('mdl_widget_navigation_group', array('WID_ID'=>$data['WID_ID'], 'NAV_GROUP_ID'=>$g[1]));
			}
			
			// pages
			else {
				
				$this->widget_m->__insert('mdl_widget_navigation_list', array('WID_ID'=>$data['WID_ID'], 'NAV_LIST_ID'=>$p));
			}
		}
		
		// send feedback 
		echo  json_encode($data['WID_ID'] ? $this->widget_m->__update('mdl_widget',$data, array('WID_ID'=>$data['WID_ID'])) : $this->widget_m->__insert('mdl_widget',$data)) ;
	}
	
	function hapus(){

		$id = $this->input->post('id');
	
		if($id){

			$this->widget_m->__delete('mdl_widget_navigation_group',array('WID_ID'=>$id));
			
			$this->widget_m->__delete('mdl_widget_navigation_list',array('WID_ID'=>$id));
			
			echo json_encode($this->widget_m->__delete('mdl_widget',array('WID_ID'=>$id)));
		
		} 
		
		echo json_encode(0);
	}
	
	function get_nav_group_list(){
		
		$id = $this->input->post('id');
		
		$varay = array();
		
		$groups = $this->widget_m->__select('mdl_widget_navigation_group', 'NAV_GROUP_ID id', array('WID_ID'=>$id));
		
		if(count($groups))	foreach($groups as $v=>$g) $varay[] = 'group_'.$g->id;
				
		$pages = $this->widget_m->__select('mdl_widget_navigation_list', 'NAV_LIST_ID id', array('WID_ID'=>$id));
		
		if( count($pages) )	foreach ($pages as $v=>$p) $varay[] =$p->id;
		
		echo json_encode($varay);
	}
	
}
