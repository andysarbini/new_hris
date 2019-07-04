<?php defined('BASEPATH') OR exit('No direct script access allowed');

class opt_m extends GW_Model {
	
	function search_options($_like){
		
		$this->db->select("*");
		
		$this->db->from("mdl_options");
		
		$this->db->like("OPT", $_like);
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function find_option_val($data){
		
		$this->db->select("OPT_VAL");
		
		$this->db->from("mdl_options");
		
		if(@if_empty($data['OPT'])){
			$this->db->where("OPT", $data['OPT']);
		}

		$query = $this->db->get();
		
		return $query->row();
	}
}
