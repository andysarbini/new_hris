<?php
class cuti_m extends GW_Model {

	/**
	 * param user id (int)
	 * return year (int)
	 */
	function get_lowest_year($usr_id = null, $table = "mdl_cuti", $column = "YEAR(tgl_from)"){
		
		$this->db->select("MIN(".$column.") year");
		
		$this->db->from($table);
		
		if($usr_id != null) $this->db->where("usr_id", $usr_id);

		$query = $this->db->get();

		return @if_empty($query->row()->year, date('Y'));
	}

	function get_list_cuti($_w = null){

		$this->db->select("c.*,t.*");
		
		$this->db->select("u.nama_lengkap, u.nip, u.atasan_nip, u.profile_picture");
	
		$this->db->from("mdl_cuti c");
		
		$this->db->join("mdl_cuti_type t", "c.type_id=t.type_id", "left");
		
		$this->db->join("mdl_user_data u", "u.usr_id=c.usr_id", "left");
		

		if(@if_empty($_w['year'])) $this->db->where("YEAR(c.tgl_from)", $_w['year']);
		
		if(@if_empty($_w['month'])) $this->db->where("MONTH(c.tgl_from)", $_w['month']);

		$this->db->order_by("c.cuti_id", "desc");
		
		$query = $this->db->get();

		return $query->result();
	}
	
	function get_cuti($_w){
		
		$this->db->select('c.*, t.*');
		
		$this->db->from('mdl_cuti c');
		
		$this->db->join('mdl_cuti_type t', 'c.type_id=t.type_id', 'left');
		
		$this->db->where($_w);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	// return number of rows
	function is_atasan($nip){
		
		$this->db->select("*");
		
		$this->db->from("mdl_user_data");
		
		$this->db->where("atasan_nip", $nip);
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
/*
	function admin_get_list($year = null, $status = null){
		
		$this->db->select("c.*, d.nama_lengkap");

		$this->db->from("mdl_cuti c");

		$this->db->join("mdl_user_data d", "c.usr_id=d.usr_id", "left");

		if($status != null) $this->db->where("status", $status);

		if($year != null) $this->db->where("YEAR(tgl_from)", $year);

		$query = $this->db->get();
		
		return $query->result();
	}
/**/
	function get_list_cuti_year($usr_id, $thn){

		$this->db->select("c.*,t.*");

		$this->db->from("mdl_cuti c");
		
		$this->db->join("mdl_cuti_type t", "c.type_id=t.type_id", "left");

		$this->db->where("c.usr_id", $usr_id);
		
		$this->db->where("YEAR(c.tgl_from)", $thn);

		$this->db->order_by("c.cuti_id", "desc");

		$query = $this->db->get();
		
		#debug($this->db->last_query());

		return $query->result();
	}
	
	function get_type_cuti($type_id=null){
		
		$this->db->select('*');
		
		$this->db->from('mdl_cuti_type');
		
		if($type_id) $this->db->where('type_id', $type_id);
		
		$query = $this->db->get();
		
		return $type_id ? $query->row() : $query->result();
	}
	
	function atasan_get_list_cuti_bawahan($_p){
		
		$this->db->select("c.*,d.*,t.*");
		
		$this->db->from("mdl_cuti c");
		
		$this->db->join("mdl_cuti_type t", "t.type_id=c.type_id", "left");
		
		$this->db->join("mdl_user_data d", "c.usr_id=d.usr_id", "left");
		
		if(isset($_w["nip"])) $this->db->where("d.atasan_nip",$_w["nip"]);
		
		if(isset($_w["year"])) $this->db->where("YEAR(c.tgl_from)",$_w["year"]);
		
		if(isset($_w["status"])) $this->db->where("c.status)",$_w["status"]);
		
		$this->db->order_by("c.cuti_id", "desc");
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}
	
	function check_autority_persetujuan($cuti_id, $atasan_nip){
		
		$this->db->select('c.*');
		
		$this->db->from('mdl_cuti c');
		
		$this->db->join('mdl_user_data d', 'c.usr_id=d.usr_id','left');
		
		$this->db->where('c.cuti_id', $cuti_id);
		
		$this->db->where('d.atasan_nip', $atasan_nip);
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function total_quota_cuti(){
		
		$this->db->select('sum(quota) as jumlah');
		
		$this->db->from('mdl_cuti_type');
		
		$this->db->where('type_id !=', 1); // cuti hamil melahirkan khusus tidak di hitung
		
		$query = $this->db->get();
		
		return $query->row()->jumlah;
	}
	
	function sudah_cuti($thn, $usr_id){
		
		$this->db->select("sum(days) as jumlah");
		
		$this->db->from("mdl_cuti");
		
		$this->db->where("usr_id", $usr_id);
		 
		$this->db->where("YEAR(tgl_from)",$thn);
		
		$this->db->where("status", 2);
		
		$this->db->where("type_id != ", 1); // cuti hamil tidak masuk dalam quota sudah cuti
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->row()->jumlah;
	}
}
