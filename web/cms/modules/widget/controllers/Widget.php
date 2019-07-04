<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class widget extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('widget_m');
	}
	
	function index(){
		echo 'ini widget ny';
	}
	
	function get_widget_pages( $_id_pages = false ){
		
		if($_id_pages){
			
			$widgets =  $this->widget_m->__select('mdl_widget', 'WID_ID id, WID_NAV nav', array('WID_ACTIVE'=>1));
			$ary_w = array();
			
			if (count($widgets)) {

				if( ! is_numeric($_id_pages))  	$ary_where = array('NAV_LIST_URI'=>$_id_pages);
				else $ary_where = array('NAV_LIST_ID'=>$_id_pages);
				
				$pages_attr = $this->widget_m->__select('mdl_navigation_list','NAV_GROUP_ID group_id, NAV_LIST_ID list_id', $ary_where, false);
				
				//var_dump($pages_attr);

				foreach ($widgets as $w) { 

					if( ! $w->nav ){
						
						// select in groups
						$groups = $this->widget_m->__select('mdl_widget_navigation_group', 'WID_ID id', array('NAV_GROUP_ID'=>$pages_attr->group_id));
					
						$pages = $this->widget_m->__select('mdl_widget_navigation_list', 'WID_ID id', array('NAV_LIST_ID'=>$pages_attr->list_id));
						
						$merges = array_merge($groups, $pages);
						
						foreach($merges as $m) $ary_w[] = $m->id;
							
					} else 
						$ary_w[] = $w->id;
				}
			}
			
			return array_unique($ary_w);
		}
	}
	
	function get_widget_content($_id = false){
		
		$ary = array();
		$_widget_select = 'WID_SCRIPT code, WID_ACTIVE acc, WID_TITLE title, WID_TITLE_SHOW title_show';
		if(is_array($_id)){
			
			foreach($_id as $i) $ary[$i] = $this->widget_m->__select('mdl_widget', $_widget_select, array('WID_ID'=>$i), false); 
		
		} else $ary[$_id] = $this->widget_m->__select('mdl_widget',$_widget_select, array('WID_ID'=>$_id), false);
		
		return $ary;
		
	}

}
