<?php
class notif_m extends GW_Model {

	function get_list_notif($usr_id, $count){
		
		$this->db->select("notif_id, title, status");
		
		$this->db->where("usr_id",$usr_id);
		
		$this->db->from("mdl_notif");
		
		$this->db->order_by("tgl", "desc");
		
		$this->db->limit(10, $count);
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function get_num_notif($usr_id){
		
		$this->db->select('COUNT(*) as count');
		
		$this->db->where("usr_id",$usr_id);
		
		$this->db->where("status",1);
		
		$this->db->from("mdl_notif");
		
		$query = $this->db->get();
		
		return $query->row()->count;
	}
}
