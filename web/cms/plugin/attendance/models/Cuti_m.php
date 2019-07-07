<?php
class cuti_m extends GW_Model {

	/**
	 * param user id (int)
	 * return year (int)
	 */
	function get_lowest_year($usr_id = null){
		
		$this->db->select("MIN(YEAR(tgl_from)) year");
		
		$this->db->from("mdl_cuti");
		
		if($usr_id != null) $this->db->where("usr_id", $usr_id);

		$query = $this->db->get();

		return $query->row()->year;
	}

	function get_list_cuti_year($usr_id, $thn){

		$this->db->select("*");

		$this->db->from("mdl_cuti");

		$this->db->where("usr_id", $usr_id);
		
		$this->db->where("YEAR(tgl_from)", $thn);

		$this->db->order_by("tgl_from", "desc");

		$query = $this->db->get();

		return $query->result();
	}

	function admin_get_list($year = null, $status = null){
		
		$this->db->select("c.*, d.nama_lengkap");

		$this->db->from("mdl_cuti c");

		$this->db->join("mdl_user_data d", "c.usr_id=d.usr_id", "left");

		if($status != null) $this->db->where("status", $status);

		if($year != null) $this->db->where("YEAR(tgl_from)", $year);

		$query = $this->db->get();
		
		return $query->result();
	}

}
