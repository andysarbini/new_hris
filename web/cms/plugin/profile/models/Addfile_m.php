<?php
class addfile_m extends GW_Model {
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * get all user list
	 */
	function get_fileupload($usr_id, $year, $month){
		
		$this->db->select("*");

		$this->db->from("mdl_user_files");

		$this->db->where("usr_id", $usr_id);
		// $this->db->where("nip", $nip);

		$this->db->where("YEAR(date_inp)", $year);
  
		$this->db->where("MONTH(date_inp)", $month);
		
		$this->db->order_by("file_id",'desc');		

		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_single_fileupload($usr_id = null, $date_inp = null, $_p = null){
		
		$this->db->select("a.*, d.*");
		
		$this->db->from("mdl_user_files a");
		
		$this->db->join("mdl_user_data d", "a.usr_id=d.usr_id", "left");
		
		if($usr_id) $this->db->where("a.usr_id", $usr_id);
		
		if($date_inp) $this->db->where("DATE(a.time_in)", $date_inp);
		
		if($_p)	$this->db->where($_p);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	
	
	function get_list_fileupload($tgl, $id = null){
		
		$this->db->select("a.*, u.*");
		
		$this->db->from("mdl_user_files a");
		
		$this->db->where("DATE(a.date_inp)", $tgl);
		
		$this->db->join("mdl_user_data u", "u.usr_id=a.usr_id", "left");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function insert_batch($data){
		
		$this->db->insert_batch("mdl_user_files", $data);
	}

	
}
