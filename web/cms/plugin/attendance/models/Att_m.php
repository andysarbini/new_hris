<?php
class att_m extends GW_Model {
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * get all user list
	 */
	function get_attendance($nip, $year, $month){
		
		$this->db->select("*");

		$this->db->from("mdl_attendance");

		#$this->db->where("usr_id", $usr_id);
		$this->db->where("nip", $nip);

		$this->db->where("YEAR(date_in)", $year);
  
		$this->db->where("MONTH(date_in)", $month);
		
		$this->db->order_by("att_id",'desc');		

		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_single_attendance($usr_id = null, $date_in = null, $_p = null){
		
		$this->db->select("a.*, d.*");
		
		$this->db->from("mdl_attendance a");
		
		$this->db->join("mdl_user_data d", "a.nip=d.nip", "left");
		
		if($usr_id) $this->db->where("a.usr_id", $usr_id);
		
		if($date_in) $this->db->where("DATE(a.time_in)", $date_in);
		
		if($_p)	$this->db->where($_p);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	
	function set_status_cuti($usr_id, $date_cuti){
		
		foreach($date_cuti as $val) {
			
		// delete dahulu row di tanggal tersebut
			$_w = array('usr_id'=>$usr_id, 'DATE(time_in)'=>$val);	
			$this->db->delete("mdl_attendance", $_w);
		//	echo 'delete:'.$this->db->last_query();
		// set row baru yg cuti
			$_i = array('usr_id'=>$usr_id, 'time_in'=>$val.' 00:00:00','status'=>'cuti');
			$this->db->insert("mdl_attendance", $_i );
		//	echo 'insert:'.$this->db->last_query();
		}
		
		
	}
	
	function get_list_attendance($tgl, $id = null){
		
		$this->db->select("a.*, u.*");
		
		$this->db->from("mdl_attendance a");
		
		$this->db->where("DATE(a.date_in)", $tgl);
		
		$this->db->join("mdl_user_data u", "u.nip=a.nip", "left");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function insert_batch($data){
		
		$this->db->insert_batch("mdl_attendance", $data);
	}

	function get_office($_off_id = array()){
		
		$this->db->select('');
		
		$this->db->from('');
		
		$this->db->where($_w_str);
	}

	function admin_get_list_revisi($_w = array()){
		
		$this->db->select('r.*, d.nama_lengkap, d.jabatan, d.profile_picture');

		$this->db->from('mdl_attendance_revisi r');

		$this->db->join('mdl_user_data d', 'd.usr_id=r.usr_id');

		foreach($_w as $var=>$val) $this->db->where($var, $val);

		$query = $this->db->get();

		debug($this->db->last_query());

		return isset($_w['rev_id']) ? $query->row(): $query->result();
	}
	
}
