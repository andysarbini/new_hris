<?php defined('BASEPATH') OR exit('No direct script access allowed');

class info_m extends GW_Model {
	
	function get_list_info($_w = array()){
		
		$this->db->select('i.*');
		
		$this->db->from('mdl_info i');
		
		$this->db->join('mdl_info_role r', 'i.info_id = r.info_id','left');
		
		if(count($_w)) $this->db->where($_w);
		
		$this->db->group_by('info_id');
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}
	
	function get_single_info($_w = array()){
	
		$_ = $this->get_list_info($_w);
		
		return $_[0];		
	}
	
	function get_menu_info_id($info_id){
		
		$this->db->select('NAV_LIST_ID id');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->where('NAV_LIST_URL', $info_id);
		
		$this->db->where('NAV_TYPE_ID', 4); // 4 = info type
		
		$query = $this->db->get();
		
		return $query->row()->id;
	}
	
	function get_menu($nav_list_id){
		
		$this->db->select('NAV_LIST_ID id, NAV_LIST_TITLE title, NAV_TYPE_ID type, NAV_LIST_URL url, NAV_LIST_PARENT_ID parent_id');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->where('NAV_LIST_ID', $nav_list_id);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
}
