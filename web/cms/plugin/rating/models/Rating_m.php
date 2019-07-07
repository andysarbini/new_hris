<?php
class rating_m extends GW_Model {
	
	/**
	 * get value from rating
	 * return single row
	 */ 
	function get($content_id, $label=NULL){
		
		if(is_array($content_id)) $content_id = $content_id["content_id"];
		
		$this->db->select("*");
		
		$this->db->from("mdl_rating");
		if($label == "forum"){
			$this->db->where("forum_id",$content_id);
		}else{
			$this->db->where("content_id",$content_id);
		}
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->row();
	}
	
	/**
	 * pernah melihat content tersebut
	 * return int
	 */	
	function is_ever_view($_w){
		
		$this->db->select("r.*, l.*");
		
		$this->db->from("mdl_rating r");
		
		$this->db->join("mdl_rating_log l", "r.content_id=l.content_id", "left");
		
		$this->db->where("r.content_id", $_w["content_id"]);
		
		$this->db->where("l.usr_id", $_w["usr_id"]);
		
		$query = $this->db->get();
		
		return count($query->row());
	}
	
	/**
	 * add 1 to view
	 * $_w[content_id, usr_id]
	 */ 
	function update($_column,$_w){		
		//Check Existing record
		$is_recorded = count($this->__select("mdl_rating", "*", array('content_id' => $_w['content_id']), false));
		# remove # jika ingin single input view dan love 
		$wth = count($this->__select("mdl_rating_log", "*", array_merge(array("type"=>$_column),$_w), false));
		$check_is_loved = count($this->__select("mdl_rating_log", "*", array_merge(array("type"=>"love"),$_w), false));
		if(! $wth ){
			$_r = $this->get($_w["content_id"]);
			
			$_c =  @if_empty((int) $_r->{$_column}, 0);
			
			//if(!$_c) $this->db->insert("mdl_rating", array("content_id"=>$_w["content_id"]));
			if(!$is_recorded){
				$this->db->insert("mdl_rating", array("content_id"=>$_w["content_id"]));
			}
			
			$_log = array("usr_id"=>$_w["usr_id"], "content_id"=>$_w["content_id"], "type"=>$_column);
			
			$this->db->insert("mdl_rating_log", $_log);

			$this->db->update("mdl_rating", array($_column=>$_c + 1), array("content_id"=>$_w["content_id"]));
		}
		$_r = $this->get($_w["content_id"]);
		if($check_is_loved){
			$_r->is_voted = true;
		}
		return $_r;
	}

	/**
	 * add 1 to view
	 * $_w[content_id, usr_id]
	 */ 
	function update_forum($_column,$_w){		
		//Check Existing record
		$is_recorded = count($this->__select("mdl_rating", "*", array('forum_id' => $_w['forum_id']), false));
		# remove # jika ingin single input view dan love 
		$wth = count($this->__select("mdl_rating_log", "*", array_merge(array("type"=>$_column),$_w), false));
		
		if(! $wth ){
			$_r = $this->get($_w["forum_id"]);
		
			$_c =  @if_empty((int) $_r->{$_column}, 0);
			
			//if(!$_c) $this->db->insert("mdl_rating", array("forum_id"=>$_w["forum_id"]));
			if(!$is_recorded){
				$this->db->insert("mdl_rating", array("content_id"=>"f".$_w["forum_id"], "forum_id"=>$_w["forum_id"]));
			}
			
			$_log = array("content_id"=>"f".$_w["forum_id"], "usr_id"=>$_w["usr_id"], "forum_id"=>$_w["forum_id"], "type"=>$_column);
			
			$this->db->insert("mdl_rating_log", $_log);

			$this->db->update("mdl_rating", array($_column=>$_c + 1), array("forum_id"=>$_w["forum_id"]));
		}
		return $this->get($_w["forum_id"], "forum");
	}
	
	function get_comment($content_id, $page = null){
		
		$limit = 5;
		
		$this->db->select("l.*,d.*");
		
		$this->db->from("mdl_rating_log l");
		
		$this->db->join("mdl_user_data d", "l.usr_id = d.usr_id", "left");
		
		$this->db->where('l.content_id', $content_id);
		
		$this->db->where('l.type', 'comment');
		
		$this->db->order_by('l.tgl', 'desc');
		
		if( $page ) $this->db->limit( $limit, ($page-1) * $limit );
		
		else $this->db->limit(1);
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}


	function get_comment_g($content_id, $page = null){
		
		$this->db->select("l.*,d.*");
		
		$this->db->from("mdl_rating_log l");
		
		$this->db->join("mdl_user_data d", "l.usr_id = d.usr_id", "left");
		
		$this->db->where('l.content_id', $content_id);
		
		$this->db->where('l.type', 'comment');
		
		$this->db->order_by('l.tgl', 'desc');
		
		if(!$page) $this->db->limit(1);
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}

	
	function update_number_comment($content_id){
		
		$_ = $this->__select('mdl_rating_log','count(*) as num', array('content_id'=>$content_id, 'type'=>'comment'), false);
		
		$this->__update('mdl_rating', array('comment'=>$_->num), array('content_id'=>$content_id));
	}
/*	
	function update_number_comment_gallery($img_id){
		
		$_ = $this->__select('mdl_rating_log','count(*) as num', array('gallery_id'=>$img_id), false);
		
		$this->__update('mdl_rating', array('comment'=>$_->num), array('gallery_id'=>$img_id));
	}

	
	function gallery_image_get_comment($img_id){
		
		$this->db->select("l.*,d.*");
		
		$this->db->from("mdl_rating_log l");
		
		$this->db->join("mdl_user_data d", "l.usr_id = d.usr_id", "left");
		
		$this->db->where('l.gallery_id', $img_id);
		
		$this->db->where('l.type', 'comment');
		
		$this->db->order_by('l.tgl', 'asc');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function gallery_image_get_last_comment($img_id){
		
		$this->db->flush_cache();
		
		$this->db->select("l.*,d.*");
		
		$this->db->from("mdl_rating_log l");
		
		$this->db->join("mdl_user_data d", "l.usr_id = d.usr_id", "left");
		
		$this->db->where('l.gallery_id', $img_id);
		
		$this->db->where('l.type', 'comment');
		
		$this->db->order_by('l.tgl', 'desc');
		
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		return $query->result();
	}/**/
}
