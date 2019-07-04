<?php
class group_m extends GW_Model {
	
	function load($_id = false){
		
		$this->db->select('USR_GRP_ID id, USR_GRP_NAME name, USR_GRP_DESC ket, USR_GRP_ACCESS acc');
		
		if( $_id ) $this->db->where('USR_GRP_ID', $_id);
		
		$this->db->from('mdl_user_group');
		
		$query = $this->db->get();
		
		return $_id ? $query->row() : $query->result();
		
	}
	
}
