<?php
class member_m extends GW_Model {
	
	function load($_id = false){
		
		$this->db->select('a.MRD_ID id, a.MRD_NAME name, a.MRD_EMAIL email, a.MRD_BIRTDAY tgl, a.MRD_SEX sex, a.MRD_ADDR addr, a.MRD_PIC pic, a.MRD_ISACTIVE active');
		
		$this->db->select('a.MRD_PIC pic, a.MRD_PIC_RAW raw, a.MRD_PIC_EXT ext');
		
		$this->db->select('b.USR_GRP_ID group_id, c.USR_GRP_NAME group_name');
		
		if( $_id ) $this->db->where('MRD_ID', $_id);
		
		$this->db->from('mdl_portal_member a');
		
		$this->db->join('mdl_user b', 'a.MRD_ID = b.USR_REF', 'left');
		
		$this->db->join('mdl_user_group c', 'c.USR_GRP_ID = b.USR_GRP_ID','left');
		
		$query = $this->db->get();
		
		return $_id ? $query->row() : $query->result();
		
	}
	
}
