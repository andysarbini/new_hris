<?php
class logs_m extends GW_Model {

	function get_last_logs($berapa = 10){
		$this->db->select("name, email, ip, DATE_FORMAT(tgl, '%d %b %Y %h:%i %p') tgl, msg", false);
		$this->db->from('mdl_logs');
		$this->db->order_by("id_log", "desc");
		$this->db->limit($berapa);
		$query = $this->db->get();
		return $query->result();

	}

	function get_last(){
		$this->db->select("*, DATE_FORMAT(tgl,'%d %b %Y %h:%i %p') tgl2", false);
		$this->db->from('mdl_logs');
		$this->db->order_by("id_log", "desc");
		$query = $this->db->get();
		return $query->row();
	}
}