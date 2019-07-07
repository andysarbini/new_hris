<?php
class bluehrd_user_m extends GW_Model {
    
    function __construct(){
        parent::__construct();
    }
    /**
     * get all user list
     */
    function user_list($page = 0, $where = null){
        
      //  $limit_per_page = 10;
        
        $this->db->select("*");
        
        $this->db->from("mdl_user_data");
        
        if($where){
        
            $this->db->where($where);
        }
        
        $this->db->order_by('usr_id', 'asc');
        
      //  $this->db->limit($limit_per_page, $page * $limit_per_page );
        
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * get user single data
     * if input id number get single
     * and input can be array param
     */
    function get_user($id=null){

        $this->db->select("d.*");

        $this->db->select("u.USR_NAME usr_name, u.USR_ACCESS usr_access");

        $this->db->select("g.USR_GRP_NAME usr_grp_name, g.USR_GRP_DESC");

        $this->db->from("mdl_user u");

        $this->db->join("mdl_user_data d", "u.USR_ID = d.usr_id", "left");

        $this->db->join("mdl_user_group g", "u.USR_GRP_ID=g.USR_GRP_ID", "left");

        if($id != null && !is_array($id) )$this->db->where("u.USR_ID", $id);
        
        else if(is_array($id)) $this->db->where($id);

        $query = $this->db->get();
#debug($this->db->last_query());
        return $query->row();
    }

    /**
     * save user data to mdl_user, mdl_user_data
     */
    function save($data){
        
    }
}
