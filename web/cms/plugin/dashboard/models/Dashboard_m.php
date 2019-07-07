<?php
class dashboard_m extends GW_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	function dashboard_news($page=null, $limit = 4){
		
		#$this->db->protect_idenifiers(FALSE);
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where_in("POST_CATEGORY", array(24, 25));
		$this->db->order_by("POST_INPUT_DATE","desc");
		if(!$page) $this->db->limit($limit);
		else $this->db->limit( $limit, ($page-1) * $limit );
		$query = $this->db->get();
		
		return $query->result();        
	}
	
	/* return integer
	 * */
	function dashboard_news_paging(){
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where_in("POST_CATEGORY", array(24, 25));
		$this->db->order_by("POST_INPUT_DATE","desc");
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function featured_articles(){
		#$this->db->protect_idenifiers(FALSE);
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where("POST_FEATURED", 1);
		//$this->db->where("POST_CATEGORY", 12);
		$this->db->where_in("POST_CATEGORY", array(12, 24, 25));
		$this->db->order_by("POST_INPUT_DATE","desc");
		//$this->db->limit("5");
		$query = $this->db->get();
		return $query->result();        
	}

	function popular_news(){
		#$this->db->protect_idenifiers(FALSE);
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->join("mdl_rating r", "r.content_id = post_id", "left");
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where_in("POST_CATEGORY", array(24, 25));
		$this->db->order_by("r.view");
		#$this->db->order_by("POST_ID", "desc");
		$this->db->limit("3");
		$query = $this->db->get();
		return $query->result();        
	}

	function latest_gallery(){
		$this->db->select("*");
		$this->db->from("mdl_gallery");
		$this->db->where("mdl_gallery.GALL_TYPE", "files");
		$this->db->order_by("mdl_gallery.GALL_UPDATE_DATE DESC, mdl_gallery.GALL_CREATE_DATE DESC");
		$this->db->limit("6");
		$query = $this->db->get();
		return $query->result();       
	}


	function single_content($id){
		$this->db->select("*");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->join('mdl_rating', 'vw_mdl_content_user_group.POST_ID = mdl_rating.content_id', 'left');
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where("POST_ID", $id);
		$query = $this->db->get();
		return $query->row();
	}

	function get_category_content_info($data){
		$this->db->select("*");
		$this->db->from("mdl_content_category");
		$this->db->where("ACTIVE", 1);
		$this->db->where("CAT_URI", $data['CAT_URI']);
		$query = $this->db->get();
		return $query->row();
	}

	function get_content_list($data){
		$this->db->select("*");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
		if(isset($data['category_id'])){
			$this->db->where("POST_CATEGORY", $data['category_id']);
		}
		if(isset($data['post_id'])){
			$this->db->where("POST_ID <>", $data['post_id']);
		}
		if(isset($data['array_category_id'])){
			$this->db->where_in("POST_CATEGORY", $data['array_category_id']);
		}
		$this->db->order_by("POST_ID", "desc");
		if($data['limit']){
			$this->db->limit($data['limit']);
		}
		$query = $this->db->get();
		return $query->result();      
	}

	function get_nav_info($data){
		$this->db->select("*");
		$this->db->from("mdl_navigation_list");
		//$this->db->where("POST_ISACTIVE", 1);
		if(isset($data['NAV_LIST_URI'])){
			$this->db->where("NAV_LIST_URI", $data['NAV_LIST_URI']);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	function category_content($id_cat=26){
		
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title");
		$this->db->select("CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
		$this->db->where("POST_CATEGORY", $id_cat);
		$this->db->order_by("POST_ID", "desc");
		$query = $this->db->get();
		return $query->result();        
	}
	
	function get_birthday_month($_w, $limit = null){
	
		$this->db->select("*");
		
		$this->db->from('mdl_user_data');
		
		$this->db->where($_w);
		
		
		if($limit) {
			
			$this->db->order_by('tgl_lahir', 'RANDOM');
			
			$this->db->limit(10);
		}
		
		else $this->db->order_by('tgl_lahir');
		
		
		$query = $this->db->get();
		
		return $query->result();
		
	}

	function get_gallery_info($filter=array()){
		$this->db->select("*");
		$this->db->from("mdl_gallery");
		if(isset($filter['GALL_URI'])){
			$this->db->where("GALL_URI", $filter['GALL_URI']);
		}
		$query = $this->db->get();
		return $query->row();        
	}

	function get_pics_of_gallery($filter=array()){
		$this->db->select("*");
		$this->db->from("vw_mdl_gallery_pic_user_group");
		if(isset($filter['GALL_ID'])){
			$this->db->where("GALL_ID", $filter['GALL_ID']);
		}
		$this->db->order_by("GALL_UPDATE_DATE DESC, GALL_CREATE_DATE DESC, GALL_PIC_ID DESC");
		$query = $this->db->get();
		return $query->result();        
	}

	function get_pics_info($filter=array()){
		$this->db->select("*");
		$this->db->from("vw_mdl_gallery_pic_user_group");
		if(isset($filter['GALL_ID'])){
			$this->db->where("GALL_ID", $filter['GALL_ID']);
		}
		$this->db->order_by("GALL_PIC_ID DESC");
		$query = $this->db->get();
		return $query->row();        
	}

	function get_galleries($filter=array()){
		$this->db->select("*");
		$this->db->from("mdl_gallery");
		$this->db->where("mdl_gallery.GALL_TYPE", "files");
		$this->db->where("mdl_gallery.GALL_ID <>", $filter['GALL_ID']);
		$this->db->order_by("mdl_gallery.GALL_UPDATE_DATE DESC, mdl_gallery.GALL_CREATE_DATE DESC");
		$this->db->limit("6");
		$query = $this->db->get();
		return $query->result();
	}

	function get_forum_categories($data){
		$this->db->select("*");
		$this->db->from("mdl_forum_category");
		if(isset($data['IS_ACTIVE'])){
			$this->db->where("IS_ACTIVE", $data['IS_ACTIVE']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function get_forum_category_info($data){
		$this->db->select("*");
		$this->db->from("mdl_forum_category");
		if(isset($data['CAT_URI'])){
			$this->db->where("CAT_URI", $data['CAT_URI']);
		}
		$query = $this->db->get();
		return $query->row_array();
	}

	function save_post_forum($data){
        $data['POST_CREATED'] = date('Y-m-d H:i:s');
        $this->db->insert('mdl_forum', $data);
        return $this->db->insert_id();
	}

	function get_post_forum_info($data){
		$this->db->select("*");
		$this->db->from("mdl_forum");
		$this->db->join('mdl_forum_category', 'mdl_forum.POST_CATEGORY_ID = mdl_forum_category.CAT_ID', 'left');
		$this->db->join('mdl_user_data', 'mdl_forum.POSTED_BY = mdl_user_data.usr_id', 'left');
		$this->db->join('mdl_rating', 'mdl_forum.POST_ID = mdl_rating.forum_id', 'left');
		if(isset($data['IS_DELETE'])){
			$this->db->where("IS_DELETE", $data['IS_DELETE']);
		}
		if(isset($data['POST_ID'])){
			$this->db->where("POST_ID", $data['POST_ID']);
		}
		if(isset($data['POST_URI'])){
			$this->db->where("POST_URI", $data['POST_URI']);
		}
		if(isset($data['order_by'])){
			$this->db->order_by($data['order_by']);
		}
		$query = $this->db->get();
		return $query->row();
	}

	function get_post_forum_list($data){
		$this->db->select("*");
		$this->db->from("mdl_forum");
		$this->db->join('mdl_forum_category', 'mdl_forum.POST_CATEGORY_ID = mdl_forum_category.CAT_ID', 'left');
		$this->db->join('mdl_user_data', 'mdl_forum.POSTED_BY = mdl_user_data.usr_id', 'left');
		$this->db->join('mdl_rating', 'mdl_forum.POST_ID = mdl_rating.forum_id', 'left');
		if(isset($data['IS_DELETE'])){
			$this->db->where("mdl_forum.IS_DELETE", $data['IS_DELETE']);
		}
		if(isset($data['IS_ACTIVE'])){
			$this->db->where("mdl_forum.IS_ACTIVE", $data['IS_ACTIVE']);
		}
		if(isset($data['POST_CATEGORY_ID'])){
			$this->db->where("mdl_forum.POST_CATEGORY_ID", $data['POST_CATEGORY_ID']);
		}
		if(isset($data['EXCEPT_URI'])){
			$this->db->where("mdl_forum.POST_URI <>", $data['EXCEPT_URI']);
		}
		if(isset($data['not_in_id'])){
			$this->db->where_not_in("mdl_forum.POST_ID", $data['not_in_id']);
		}
        if(isset($data['limit']) && isset($data['offset'])){
            $this->db->limit($data['limit'], $data['offset']);
        }
		if(isset($data['order_by'])){
			$this->db->order_by($data['order_by']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function edit_post_forum($data){
		$data['POST_MODIFIED'] = date('Y-m-d H:i:s');
		if(isset($data['POST_ID'])){
			$this->db->where("POST_ID", $data['POST_ID']);
		}
        $this->db->update('mdl_forum', $data);
        return true;
	}

	function get_info_rating_log($data){
		$this->db->select("*");
		$this->db->from("mdl_rating_log");
		if(isset($data['usr_id'])){
			$this->db->where("mdl_rating_log.usr_id", $data['usr_id']);
		}
		if(isset($data['forum_id'])){
			$this->db->where("mdl_rating_log.forum_id", $data['forum_id']);
		}
		if(isset($data['content_id'])){
			$this->db->where("mdl_rating_log.content_id", $data['content_id']);
		}
		if(isset($data['gallery_id'])){
			$this->db->where("mdl_rating_log.gallery_id", $data['gallery_id']);
		}
		$query = $this->db->get();
		return $query->row();
	}

	function insert_info_rating_log($data){
        $data['tgl'] = date('Y-m-d H:i:s');
        $this->db->insert('mdl_rating_log', $data);
        return $this->db->insert_id();
	}

	function get_info_rating($data){
		$this->db->select("*");
		$this->db->from("mdl_rating");
		if(isset($data['forum_id'])){
			$this->db->where("mdl_rating.forum_id", $data['forum_id']);
		}
		if(isset($data['content_id'])){
			$this->db->where("mdl_rating.content_id", $data['content_id']);
		}
		if(isset($data['gallery_id'])){
			$this->db->where("mdl_rating.gallery_id", $data['gallery_id']);
		}
		$query = $this->db->get();
		return $query->row();
	}

	function insert_info_rating($data){
        $this->db->insert('mdl_rating', $data);
        return $this->db->insert_id();
	}

	function update_info_rating($data){
		if(isset($data['rating_id'])){
			$this->db->where("rating_id", $data['rating_id']);
		}
        $this->db->update('mdl_rating', $data);
        return true;
	}

	function get_options($data){
		$this->db->select("OPT_VAL");
		$this->db->from("mdl_options");
		if(isset($data['OPT'])){
			$this->db->where("OPT", $data['OPT']);
		}
		$query = $this->db->get();
		return $query->row();
	}

	function check_is_already_rated($post_id, $user_id, $label, $type){
		$this->db->select("*");
		$this->db->from("mdl_rating_log");
		$this->db->where("mdl_rating_log.type", $type);
		$this->db->where("mdl_rating_log.usr_id", $user_id);
		if($label == "content"){
			$this->db->where("mdl_rating_log.content_id", $post_id);
		}
		if($label == "forum"){
			$this->db->where("mdl_rating_log.forum_id", $post_id);
		}
		if($label == "gallery"){
			$this->db->where("mdl_rating_log.gallery_id", $post_id);
		}
		$query = $this->db->get();
		$result = $query->row();
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}
