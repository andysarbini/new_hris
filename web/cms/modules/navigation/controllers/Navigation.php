<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class navigation extends MX_Controller {
	
	private $menus = array();
	
	function __construct(){
		parent::__construct();
		$this->load->model('navigation_m');
	}
	
	/**
	 * hanya dapatkan susunan array menu 
	 * fungsi ini sama dengan fungsi yang ada pada admin navigation
	 * @param unknown_type $_group = id menu
	 * @param unknown_type $_parent = parent menu / untuk reqursip pencarian anak
	 * @param unknown_type $level = menentukan tingkatan anak
	 */
	public function generate_array_menu($_group, $_parent=0, $_level=0, $_stop=false){
		
		// accept uri
		if(!is_numeric($_group)) $_group = $this->navigation_m->__select('mdl_navigation_group', 'NAV_GROUP_ID id',array('NAV_URI'=>$_group), false)->id;
		
		// reset value if parent = 0
		if(!$_parent) $this->menus = array();
	
		$this->navigation_m->parent_option($_group);
		$menus = $this->navigation_m->get_nav_list(false, $_group, $_parent, 'array');
	
		if(count($menus)) {
			foreach($menus as $m){
				$m['level'] = $_level;
				$this->menus[] = $m; //array('id'=>$m->id, 'title'=>$m->title, 'uri'=>$m->uri, 'url'=>$m->url);
				$this->generate_array_menu($_group, $m['id'], $_level+1, $_stop);
			}
		}
		# return value if parent = 0 -> global menu
		if($_parent === 0 && $_stop === false) return $this->menus;
		
		# specifik get child from parent
		if($_parent != 0 && $_stop === $_parent ) return $this->menus;
	}
	/**
	 * 
	 * @param unknown_type $_group = id menu
	 */
	public function generate_menu($_group, $navigation = 'navigation'){
		$this->generate_array_menu($_group);
		echo $this->load->view($navigation, array('menus'=> $this->menus));
	}
	/**
	 * mengubah keluaran array yg 1 dimensi menjadi 2
	 * dengan child yg berisi dari jadi childs array
	 */
	public function generate_menu_array2($_group, $navigation = 'navigation'){
		
		$this->generate_array_menu($_group);
		
		$_t 	= array();
		
		$_now 	= -1;
		
		foreach($this->menus as $var=>$val){
			
			if($val["parent_id"] == "0" || $val["parent_id"] == 0) {
		
				$_now++;
		
				$_t[] = $val;
			}
			else $_t[$_now]["childs"][] = $val; 
		}
		
		echo $this->load->view($navigation, array('menus'=> $_t));
	}
	
	public function generate_menu_child($_group, $_parent, $view = true){
		
		if(!is_numeric($_parent)) $_parent = $this->navigation_m->pages_uri_to_id($_parent);
		
		$this->menus = array(); // reset
		$this->generate_array_menu($_group, $_parent);
		//print_r($this->menus);
		
		if($view) echo $this->load->view('child-nav', array('menus'=> $this->menus));
		
		else return $this->menus;
	}
	
	/** versi kedua memiliki childs * /
	public function generate_menu2($_group, $navigation = 'navigation'){
		$menus = $this->generate_array_menu2($_group);
		dump_exit($menus, "menus");
		echo $this->load->view($navigation, array('menus'=> $menus));
	}

	public function generate_array_menu2($_group, $_parent=0, $_level=0, $_stop=false){
		
		// accept uri
		if(!is_numeric($_group)) $_group = $this->navigation_m->__select('mdl_navigation_group', 'NAV_GROUP_ID id',array('NAV_URI'=>$_group), false)->id;
		
		// reset value if parent = 0
		#if(!$_parent) $this->menus = array();
	
		$this->navigation_m->parent_option($_group);
		
		$menus = $this->navigation_m->get_nav_list(false, $_group, $_parent, 'array');
		
		$_menus = array();
		
		if(count($menus)) {
			foreach($menus as $m){
				$m['level'] 	= $_level;
				$m['childs']	= $this->generate_array_menu2($_group, $m['id'], $_level+1, $_stop);
				$menus[] 		= $m; //array('id'=>$m->id, 'title'=>$m->title, 'uri'=>$m->uri, 'url'=>$m->url);
			}
		}
		return $menus;

		# return value if parent = 0 -> global menu
		#if($_parent === 0 && $_stop === false) return $this->menus;
		
		# specifik get child from parent
		#if($_parent != 0 && $_stop === $_parent ) return $this->menus;
	}
	*/
}
