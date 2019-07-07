<?php
class qa_m extends GW_Model {

	/**
	 * param usr_id (int)
	 */
	function get_qa($qa_id = null, $status=null, $usr_id=null){
		
		$this->db->select("qa.*, usr.*");
		
		$this->db->from("mdl_qa qa");
		
		$this->db->join("mdl_user_data usr", "usr.usr_id=qa.usr_id", "left");
		
		if($qa_id) $this->db->where("qa.qa_id", $qa_id);
		
		if($status) $this->db->where("qa.status", $status);
		
		if($usr_id) $this->db->where("qa.usr_id", $usr_id);
		
		$this->db->order_by("qa_date", "desc");
		
		$query = $this->db->get();
		
		#debug($this->db->last_query());
		
		return $qa_id ? $query->row() : $query->result();
	}
	
	function get_qa_ask($_w){
		
		$this->db->select("a.*, u.*");
		
		$this->db->from("mdl_qa_ask a");
		
		$this->db->join("mdl_user_data u","a.usr_id=u.usr_id","left");
		
		$this->db->where($_w);
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function get_answer_by_qa($qa_id = null){

		$this->db->select("log.*, usr.*");
		
		$this->db->from("mdl_qa_log log");
		
		$this->db->join("mdl_user_data usr", "usr.usr_id=log.usr_id", "left");
		
		$this->db->where("qa_id",$qa_id);
		
		$this->db->order_by("date_log");
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function save_qa($data){
		
		return $this->__insert("mdl_qa", $data);
	}
	
	function save_qa_log($data){
		
		return $this->__insert("mdl_qa_log", $data);
	}
	
	function update_status_qa($qa_id, $status){
		
		
	}
}
