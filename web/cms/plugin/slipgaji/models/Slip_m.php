<?php
class slip_m extends GW_Model {

	function get_list_slip($_w = null){

		$this->db->select("c.*");
		
		$this->db->select("u.nama_lengkap, u.nip, u.profile_picture");
	
		$this->db->from("mdl_slipgaji c");
		
		$this->db->join("mdl_user_data u", "u.usr_id=c.usr_id", "left");

		if(@if_empty($_w['year'])) $this->db->where("tahun", $_w['year']);
		
		if(@if_empty($_w['month'])) $this->db->where("bulan", $_w['month']);

		$this->db->order_by("c.slip_id", "desc");
		
		$query = $this->db->get();

		return $query->result();
	}
	
	// untuk admin param hanya slip_id
	// untuk user param slip_id & usr_id
	function get_slip($_w){
		
		$this->db->select("c.*");
		
		$this->db->select("u.nama_lengkap, u.nip, u.profile_picture");
	
		$this->db->from("mdl_slipgaji c");
		
		$this->db->join("mdl_user_data u", "u.usr_id=c.usr_id", "left");
		
		$this->db->where($_w);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	// jika user dapat menghapus slip gaji, tambah param usr_id
	function delete_slip($_w){
		
		$this->__delete("mdl_slipgaji", $_w);
	}
	
}
