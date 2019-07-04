<?php
class pages_m extends GW_Model {
	
	
	
	function load_content($_uri = false){
		$this->db->select('');
		$this->db->from();
		if($_uri) $this->db->where();
		$query = $this->db->get();
		return ($_uri ) ? $query->row() : $query->result();
	}
	
	function get_pages($_uri = false){
		
		//echo '_uri:'.$_uri.'<br />';
		
		$this->db->select('a.NAV_LIST_ID id, a.NAV_LIST_TITLE title, a.NAV_GROUP_ID group_id'); // id, title page, from navigation
		
		$this->db->select('b.POST_CONTENT content'); // content page, from content
		
		$this->db->from('mdl_navigation_list a');
		
		
		$this->db->where('a.NAV_LIST_URI', $_uri);
	
		$this->db->join('mdl_content b', 'b.POST_URI= a.NAV_LIST_URL','left');
		
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function get_title($_uri){
		$this->db->select('NAV_LIST_TITLE title');
		$this->db->from('mdl_navigation_list');
		$this->db->where('NAV_LIST_URI', $_uri);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row()->title;
	}	
}
