<?php
class content_m extends GW_Model {

	function content_m() {
		parent::__construct();
	}
	
	public function simpan($data, $operasi_input=true){

		if($data['POST_MAINPAGE']) $this->db->update('mdl_content', array('POST_MAINPAGE' => 0 )); // UPDATE MAINPAGE

		if($operasi_input){
			$this->db->set('POST_INPUT_BY', get_session('user_id'));
			$this->db->set('POST_INPUT_DATE', 'NOW()',false);
			$this->db->insert('mdl_content', $data);
		} else {
			$this->db->set('POST_UPDATE_BY', get_session('user_id'));
			$this->db->set('POST_UPDATE_DATE', 'NOW()',false);
			$this->db->where('POST_ID',$data['POST_ID']);
			$this->db->update('mdl_content', $data);
		}

		return $this->db->affected_rows();
	}
	public function view($id_content = false, $offset=0, $limit=10, $id_category=false){
		// id post
		$this->db->select('POST_ID id');
		// title
		$this->db->select('POST_TITLE title');
		// uri
		$this->db->select('POST_URI uri');
		// description
		$this->db->select('POST_DESCRIPTION description');
		$this->db->select('POST_TITLE_SHORT title_short');
		// content
		if($id_content) $this->db->select('POST_CONTENT content');
		// input name group date
		$this->db->select('POST_INPUT_BY input_id, USR_NAME_INPUT input_name, USR_GRP_NAME_INPUT input_group, POST_INPUT_DATE input_date');
		// update name group date
		$this->db->select('POST_UPDATE_BY update_id, USR_NAME_UPDATE update_name, USR_GRP_NAME_UPDATE update_group, POST_UPDATE_DATE update_date');
		// 
		$this->db->select('POST_ISACTIVE active, POST_CATEGORY category, CAT_TITLE category_title');

		$this->db->select('POST_MAINPAGE mainpage');
		$this->db->select('POST_FEATURE_IMAGE feature_img');
		// view  content user group
		$this->db->from('vw_mdl_content_user_group');
		
		if($id_category) $this->db->where('POST_CATEGORY', $id_category);
		
		if($id_content && is_numeric($id_content)) $this->db->where('POST_ID', $id_content);
		
		//else $this->db->where('POST_URI', $id_content);
		
		$this->db->order_by('POST_INPUT_DATE','desc');
		
		if($offset === 0 && $limit > 0 ) $this->db->limit($limit);
		
		else $this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		//dump($this->db->last_query());
		return $id_content ? $query->row():$query->result();
	}
	
	public function delete($id_content = false){
		if($id_content){
			$this->db->delete('mdl_content',array('POST_ID'=>$id_content));
		}
		return $this->db->affected_rows();
	}
	
	function get_content($_where = array(), $offset=0, $limit=10, $order=false){
		
		$this->db->select('POST_ID id, POST_TITLE title, POST_CONTENT content, POST_URI uri, POST_FEATURE_IMAGE feature_img');

		$this->db->select('POST_DESCRIPTION description');
		
		$this->db->select('POST_TITLE_SHORT title_short');

		$this->db->select('CAT_URI cat_uri');
		
		$this->db->select('POST_INPUT_DATE tgl');
		
		$this->db->select('USR_NAME_INPUT author');
		
		$this->db->from('vw_mdl_content_user_group');
		
		//$this->db->where('POST_ISACTIVE', 1);
		
		if(count($_where)) foreach ($_where as $_var=>$_val) $this->db->where($_var, $_val);
		
		if($order) {
			
			if(is_array($order)) {
				
				foreach ($order as $col=>$ord)

					$this->db->order_by($col,$ord);
			} 
				 
			else $this->db->order_by('POST_ID',$order);
		}
		
		if( isset($_where['POST_URI']) ){
			
			$this->db->limit(1);
		}
		 
		else {
			
			$this->db->order_by('POST_INPUT_DATE','desc');
			//die(dump($offset));
			if($offset!=0){ $this->db->limit($limit,$offset); //echo '@if';
			}
			else { $this->db->limit($limit); //echo '@else';
			}
		}

		$query = $this->db->get();
		//die(dump($this->db->last_query()));
		//dump($this->db->last_query());
		return isset($_where['POST_URI']) ? $query->row() : $query->result();
	}
	
	

}
