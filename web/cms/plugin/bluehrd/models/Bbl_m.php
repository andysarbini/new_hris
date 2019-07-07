<?php
class bbl_m extends GW_Model {
    
    function __construct(){
		
        parent::__construct();
    }
    
    function bbl_get_content($_w){
		
		$this->db->select('c.POST_CONTENT content, c.POST_ID content_id, c.POST_TITLE title');
		
		$this->db->from('mdl_bluehrd_bbl_role bbl');
		
		$this->db->join('mdl_content c ', 'bbl.content_id=c.POST_ID', 'left');
		
		$this->db->where($_w);
		
		$this->db->group_by('bbl.content_id');
		
		$query = $this->db->get();
		
		return $query->row();
	}
    
    function bbl_get_list($_w=array()){
		
		$this->db->select('bbl.*, c.POST_TITLE title');
		
		$this->db->from('mdl_bluehrd_bbl_role bbl');
		
		$this->db->join('mdl_content c', 'bbl.content_id=c.POST_ID');
		
		if(@if_empty($_w['category'])){
			$this->db->where('c.POST_CATEGORY', '26');
			//$this->db->or_where('bbl.content_id', '0');
		}

		if(@if_empty($_w['company'])){
			$this->db->where('bbl.company', $_w['company']);
		}

		if(@if_empty($_w['jabatan'])){
			$this->db->where('bbl.jabatan', $_w['jabatan']);
		}

		if(@if_empty($_w['level'])){
			$this->db->where('bbl.level', $_w['level']);
		}

		if(@if_empty($_w['grade'])){
			$this->db->where('bbl.grade', $_w['grade']);
		}
		
		$this->db->group_by('bbl.content_id');
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}

	function get_distinct_user_data($column){
		
		$this->db->select("distinct({$column}) c");
		
		$this->db->from("mdl_user_data");
		
		$this->db->where($column." IS NOT NULL", null, false);
		
		$query = $this->db->get();
		
		$_ = $query->result();
		
		$_result = array();
		
		foreach($_ as $var=>$v) if($v->c != '') $_result[] = $v->c;
		
		return $_result;
	}

	function get_content_bbl(){

		$this->db->select('POST_ID, POST_TITLE, POST_CATEGORY');

		$this->db->from("mdl_content");

		$this->db->where('POST_CATEGORY', '26');

		$this->db->where('POST_ISACTIVE', '1');

		$this->db->order_by('POST_ID DESC');

		$query = $this->db->get();

		return $query->result();
	}
	
}
