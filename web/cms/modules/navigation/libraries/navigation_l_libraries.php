<?php
class navigation_l_libraries {
	
	private $menus = array();
	private $ci;
	
	function __construct(){
		$this->ci = get_instance();
		$this->ci->load->model('navigation/navigation_m');
	}
	
	public function generate_array_menu($_group, $_parent=0, $level=0){
		// reset value if parent = 0
		if(!$_parent) $this->menus = array();
		
		$this->ci->navigation_m->parent_option($_group);
		
		$menus = $this->ci->navigation_m->get_nav_list(false, $_group, $_parent, 'array');
		
		if(count($menus)) {
			foreach($menus as $m){
				$m['level'] = $level;
				$this->menus[] = $m; //array('id'=>$m->id, 'title'=>$m->title, 'uri'=>$m->uri, 'url'=>$m->url); 
				$this->generate_array_menu($_group, $m['id'], $level+1);
			}
		}
		# return value if parent = 0
		if($_parent === 0) return $this->menus;
	}
	
	//
	public function ping(){
		return 'echo  from navigation_l_libraries->pong';
	}
}