<?php
class user_m extends GW_Model {

	function __construct() {
		parent::__construct();
	}
	/**
	 * get_group
	 * @param number $grp_id		false
	 * @param number $just_access	true
	 *
	 * grp_id false => return all group user
	 * just_access true => just group with access = 1
	 */

	function get_group($grp_id=false, $just_access=true){

        $this->db->select('USR_GRP_ID group_id, USR_GRP_NAME group_name, USR_GRP_DESC group_desc');

        $this->db->from('mdl_user_group');

        if($just_access) $this->db->where('USR_GRP_ACCESS', 1);

        if($grp_id) $this->db->where('USR_GRP_ID', $grp_id);

        $query = $this->db->get();

        return $query->result();
	}
}
