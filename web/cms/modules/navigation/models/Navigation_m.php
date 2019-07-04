<?php
class navigation_m extends GW_Model {
	function __construct(){
		parent::__construct();
	}
	/**
	 * FALSE FALSE => GET ALL
	 * NUMBER FALSE => GET DETAIL
	 * FALSE NUMBER => GET JUST ACTIVE
	 * @param NUMBER $_id
	 * @param BOOLEAN $_active
	 */
	function get_nav($_id=false, $_active=1){		
		$this->db->select('a.NAV_GROUP_ID id');
		$this->db->select('a.NAV_TITLE title');
		$this->db->select('a.NAV_URI uri');
		$this->db->select('a.NAV_OWNER group_id');
		$this->db->select('b.USR_GRP_NAME group_name');		
		$this->db->from('mdl_navigation_group a');
		$this->db->join('mdl_user_group b', 'a.NAV_OWNER = b.USR_GRP_ID');
		if($_id) $this->db->where('a.NAV_GROUP_ID',$_id);
		$this->db->where('a.NAV_ACTIVE',$_active);
		$query = $this->db->get();
		if($_id) return $query->row();
		return $query->result();
	}
	
	function hapus_nav($_id){
		//$this->db->where('NAV_GROUP_ID', $_id);
		//$this->db->update('mdl_navigation_group', array('NAV_ACTIVE'=>0));
		
		$this->__delete('mdl_navigation_group', array('NAV_GROUP_ID' => $_id));
		$this->__delete('mdl_navigation_list', array('NAV_GROUP_ID' => $_id));
	}
	
	function simpan($data=array()){
		// update
		if($data['NAV_GROUP_ID']){
			$this->db->where('NAV_GROUP_ID', $data['NAV_GROUP_ID']);
			$this->db->update('mdl_navigation_group', $data); 
		}
		// input
		else {
			unset($data['NAV_ID']);
			$this->db->insert('mdl_navigation_group', $data);
		}
	}
	/**
	 * not to secure, if user can intercept $_group variable n
	 * if the user (from) group can access navigation/admin
	 * he can access the navigation which more high from him
	 * @param number $_group
	 * @param number $_id
	 * @param number $_parent
	 * @param number $result out with objek or array
	 */
	function get_nav_list($_id = false, $_group=false, $_parent=false, $result='objek'){
		
		$this->db->select('NAV_GROUP_ID group_id');
		
		$this->db->select('NAV_LIST_ID id');
		
		$this->db->select('NAV_LIST_TITLE title');
		
		$this->db->select('NAV_TYPE_ID type_id');
		
		$this->db->select('NAV_LIST_URI uri');
		
		$this->db->select('NAV_LIST_URL url');
		
		$this->db->select('mdl_content.POST_TITLE content');
		
		$this->db->select('NAV_LIST_PARENT_ID parent_id');
		
		$this->db->select('NAV_LIST_TARGET target');
		
		$this->db->select('NAV_LIST_POSSITION poss');
		
		$this->db->select('NAV_LIST_DEFAULT home');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->join('mdl_content', 'mdl_content.POST_URI=NAV_LIST_URL','left outer');
		
		if($_id) $this->db->where('NAV_LIST_ID', $_id);
		
		if(is_numeric($_group))$this->db->where('NAV_GROUP_ID', $_group);
		
		else $this->db->where('NAV_LIST_URI', $_group);
		
		if($_parent or $_parent===0 ) $this->db->where('NAV_LIST_PARENT_ID', $_parent);
		
		$this->db->order_by('NAV_LIST_PARENT_ID');
		
		$this->db->order_by('NAV_LIST_POSSITION');
		
		$query = $this->db->get();
		
		//echo '<script> console.log(\"'.addslashes($this->db->last_query()).'\");</script>';
		
		if($_id) return $query->row();
		
		else {

			if($result === 'objek') return $query->result();
			
			else return $query->result_array();
		}
	}
	
	function simpan_list($data=array()){
		
		// update
		if($data['NAV_LIST_ID']){
			
			$this->db->where('NAV_LIST_ID', $data['NAV_LIST_ID']);
			
			$this->db->update('mdl_navigation_list', $data);
		}
		// input
		else {
			
			unset($data['NAV_LIST_ID']);
			
			$this->db->insert('mdl_navigation_list', $data);
		}
	}
		
	function parent_option($_group=false){
		
		$this->db->select('NAV_LIST_ID id');
		
		$this->db->select('NAV_LIST_TITLE title');
		
		$this->db->from('mdl_navigation_list');
		
		if(is_numeric($_group))$this->db->where('NAV_GROUP_ID', $_group);
		
		else $this->db->where('NAV_LIST_URI', $_group);
		
		$query = $this->db->get();
		
		return $query->result();		
	}
	
}
