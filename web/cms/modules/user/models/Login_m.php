<?php
class login_m extends GW_Model {

	function __construct() {
		parent::__construct();
	}

	function login_user($data){

		$this->db->select('a.USR_ID user_id, a.USR_NAME name, a.USR_EMAIL email, a.USR_REF usr_ref'); // user

		$this->db->select('b.USR_GRP_ID group_id, b.USR_GRP_NAME group_name'); // group

		$this->db->from('mdl_user a');

		$this->db->join('mdl_user_group b', 'a.USR_GRP_ID=b.USR_GRP_ID', 'LEFT OUTER');

		if( strpos($data['email'], '@')) $this->db->where('a.USR_EMAIL', $data['email']);

		else $this->db->where('a.USR_NAME', $data['email']);

		$this->db->where('a.USR_PASS', $data['password']);

		$this->db->where('b.USR_GRP_ACCESS', 1);

		$this->db->where('a.USR_ACCESS', 1);

		$query = $this->db->get();
		//echo $this->db->last_query();
		//dump($query->row_array());
		//echo ENVIRONTMENT;
		return $query->row_array();
	}
}
