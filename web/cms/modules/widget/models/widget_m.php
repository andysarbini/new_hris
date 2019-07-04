<?php
class widget_m extends GW_Model {
	
	function load_list_widget($_id = false){
		
		$this->db->select('a.WID_ID id, a.WID_TITLE title, a.WID_TITLE_SHOW title_show, a.WID_URI uri, a.WID_SCRIPT script, a.WID_NAV nav, a.WID_ACTIVE active');
		
		$this->db->select('b.STAT acc');
		
		$this->db->join('mstr_status b', 'a.WID_ACTIVE = b.STAT_ID', 'left');
		
		$this->db->from('mdl_widget a');
		
		if($_id)$this->db->where('a.WID_ID', $_id);
		
		$query = $this->db->get();
		
		return $_id ? $query->row() : $query->result();
		
	}
	
	/**
	 * dapatkan group navigation dari table navigation
	 */	
	function get_group_navigation(){
		
		$this->db->select('NAV_GROUP_ID id, NAV_TITLE title');
		
		$this->db->from('mdl_navigation_group');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
}
