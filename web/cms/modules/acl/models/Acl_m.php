<?php
class acl_m extends GW_Model {
	
	function getAllGroup(){
		return $this->__select('mdl_user_group', 'USR_GRP_ID id, USR_GRP_NAME title', array('USR_GRP_ACCESS'=>1));
	}
	
	function getAcl($id_group, $id_acl){
		$this->db->select('a.ACL_ID acl_id, a.USR_GRP_ID id, b.MDL_ID id_module, b.MDL_NAME module, a.ACL_VIEW v, a.ACL_INSERT i, a.ACL_UPDATE u, a.ACL_DELETE d');
		$this->db->from('mdl_acl a');
		$this->db->join('mdl_module b','b.MDL_ID = a.MDL_ID');
		if($id_group) $this->db->where('a.USR_GRP_ID', $id_group);
		if($id_acl) $this->db->where('a.ACL_ID', $id_acl);
		$this->db->where('b.MDL_ISACTIVE', 1);
		$query = $this->db->get();
		return $id_acl ? $query->row() : $query->result();
	}
	
	function getModule($id_module = null){
		$select = 'MDL_ID id, MDL_NAME name, MDL_KET ket, MDL_ISACTIVE isactive';
		$where	= $id_module ? array('MDL_ID'=>$id_module) : array();
		$return = $id_module ? false : true;
		return $this->__select('mdl_module', $select, $where, $return);
	}
	
	function acl($group, $module){
		$this->db->select('a.ACL_ID acl_id, a.USR_GRP_ID id, b.MDL_ID id_module, b.MDL_NAME module, a.ACL_VIEW v, a.ACL_INSERT i, a.ACL_UPDATE u, a.ACL_DELETE d');
		$this->db->from('mdl_acl a');
		$this->db->join('mdl_module b','b.MDL_ID = a.MDL_ID');
		$this->db->where('a.USR_GRP_ID', $group);
		$this->db->where('b.MDL_NAME', $module);
		$this->db->where('b.MDL_ISACTIVE', 1);
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function getListModule(){
		$select = 'MDL_ID id, MDL_NAME name, MDL_KET ket';
		$where	= array('MDL_ISACTIVE'=>1);
		return $this->__select('mdl_module', $select, $where);
	}
}
