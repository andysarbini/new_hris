<?php
class break_m extends GW_Model {
	function ping(){
		return 'hello from '.__FILE__;
	}
	
	function select_from_property(){
		
		$this->db->select('pro_name name, pro_addres addres');
		
		$this->db->from('property');
		
		//some need other function here
		var_dump($this->this_make_crash());
		
		$this->db->where('id_member', 3);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function this_make_crash(){
		
		$this->db->select('*');
		
		$this->db->from('user');
		
		$this->db->where('id',4);
		
		$query = $this->db->get();
		
		return $query->row();
	}
}
