<?php
class gallery_m extends GW_Model {
	
	/**
	 * view or detail gallery
	 * @param string/boolean false $_id
	 */
	
	var $table_gallery = array(
			
			'id'=>'GALL_ID',
			'name'=>'GALL_NAME',
			'uri'=>'GALL_URI',
			'description'=>'GALL_DESC',
			'template'=>'GALL_TEMPLATE',
			'input_id'=>'GALL_CREATE_BY',
			'input_name'=>'USR_NAME_CREATE',
			'input_group'=>'USR_GRP_NAME_CREATE',
			'input_date'=>'GALL_CREATE_DATE',
			'update_id'=>'GALL_UPDATE_BY',
			'update_name'=>'USR_NAME_UPDATE',
			'update_group'=>'USR_GRP_NAME_UPDATE',
			'update_date'=>'GALL_UPDATE_DATE'
	);
	
	public function view($_id = false){
		
		$select = $this->__gen_query_select($this->table_gallery);
		
		if($_id) return $this->__select('vw_mdl_gallery_user_group', $select, array('GALL_ID'=>$_id), false);
			
		else return $this->__select('vw_mdl_gallery_user_group', $select);
	}
	
	/**
	 * save to db, gallery data
	 * @param array $data
	 * @param boolean $operasi_input
	 */
	public function simpan($data, $operasi_input=true){
		if($operasi_input){
			$this->db->set('GALL_CREATE_BY', get_session('user_id'));
			$this->db->set('GALL_CREATE_DATE', 'NOW()',false);
			$this->db->insert('mdl_gallery', $data);
		} else {
			$this->db->set('GALL_UPDATE_BY', get_session('user_id'));
			$this->db->set('GALL_UPDATE_DATE', 'NOW()',false);
			$this->db->where('GALL_ID',$data['GALL_ID']);
			$this->db->update('mdl_gallery', $data);
		}
		return $this->db->affected_rows();
	}
	
	/**
	 * get list image from gallery
	 * @param string/boolean false $_id
	 */
	public function view_image($_id=false){
			
		$this->db->select('GALL_PIC_ID id, GALL_PIC_NAME name, GALL_PIC_URI uri');
		
		$this->db->select('GALL_PIC_PATH path, GALL_PIC_DESC description');
		
		$this->db->select('GALL_PIC_DEFAULT main');
		
		$this->db->from('mdl_gallery_pic');
		
		$this->db->where('GALL_ID',$_id);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	 * 
	 * @param array $img
	 */
	public function simpan_img($img = array()){
		$this->db->set('GALL_PIC_CREATE_BY', get_session('user_id'));
		$this->db->set('GALL_PIC_CREATE_DATE', 'NOW()',FALSE);
		$id_img = 0;
		if(!$img['GALL_PIC_ID'])
			$id_img = $this->db->insert('mdl_gallery_pic',$img);
		else {
			
			if($img['GALL_PIC_URI'] === '') unset($img['GALL_PIC_URI']);
			if($img['GALL_PIC_PATH'] === '') unset($img['GALL_PIC_PATH']);
			
			$this->db->where('GALL_PIC_ID', $img['GALL_PIC_ID']);
			$this->db->update('mdl_gallery_pic',$img);
			
			$id_img = $img['GALL_PIC_ID'];
		}
		$this->default_pic_for_gallery($id_img, $img['GALL_PIC_DEFAULT'],$img['GALL_ID'] );
	}
	
	/**
	 * 	menjadikan nilai default sebuah image pada gallery
	 */
	public function default_pic_for_gallery($pic_id, $is_default, $gallery_id){
		if($is_default){
			$this->db->where(array('GALL_ID'=>$gallery_id, 'GALL_PIC_ID !='=>$pic_id));
			$this->db->update("mdl_gallery_pic", array('GALL_PIC_DEFAULT'=>0));
		}
	} 
	
	/**
	 * delete image gallery
	 * @param unknown_type $_id
	 */
	public function delete_img($_id_gall=false, $_id_pic=false){
		// delete gallery
		if($_id_gall){
			// get data
			$this->db->select('GALL_PIC_PATH path');
			$this->db->from('mdl_gallery_pic');
			$this->db->where('GALL_ID', $_id_gall);
			$query = $this->db->get();
			// delete data
			$this->db->delete('mdl_gallery', array('GALL_ID' => $_id_gall));
			$this->db->delete('mdl_gallery_pic', array('GALL_ID' => $_id_gall));
		}
	
		// delete image
		if($_id_pic){
			// get data
			$this->db->select('GALL_PIC_PATH path');
			$this->db->from('mdl_gallery_pic');
			$this->db->where('GALL_PIC_ID', $_id_pic);
			$query = $this->db->get();
			// delete
			$this->db->delete('mdl_gallery_pic', array('GALL_PIC_ID' => $_id_pic));
		}
	
		// delete the path data
		$ci = get_instance();
		$this->load->config('gallery');
		$dir = $this->config->item('mdl_gallery_upload_path');
		foreach($query->result() as $d){
			unlink($dir.'/'.$d->path);
		}
	
		return $this->db->affected_rows();
	}
	
	
	function view_img($_id_gall=false, $_id_pic=false){
		return $this->__select('mdl_gallery_pic', 'GALL_ID gall_id, GALL_PIC_ID pic_id, GALL_PIC_NAME name, GALL_PIC_PATH path, GALL_PIC_DESC ket, GALL_PIC_DEFAULT main, POST_ID post_id', array('GALL_ID'=>$_id_gall, 'GALL_PIC_ID'=>$_id_pic),false);
	}
	
	/**
	 * view gallery image
	 */ 
	function get_gallery_info($_uri_id){
		$where = is_numeric($_uri_id) ? 'GALL_ID':'GALL_URI';
		return $this->__select('vw_mdl_gallery_user_group', 'GALL_ID gall_id, GALL_NAME gall_name, GALL_URI gall_uri, GALL_DESC gall_ket, GALL_TEMPLATE template',array($where=>$_uri_id), false);
		
	}
	
	function get_gallery_pic($_uri_id){
		
		if(!is_numeric($_uri_id)) {
			$gall = $this->get_gallery_info($_uri_id);
			$_uri_id = $gall->gall_id;
		}
		
		return $this->__select('mdl_gallery_pic', 'GALL_PIC_ID pic_id, GALL_PIC_NAME pic_name, GALL_PIC_URI pic_uri, GALL_PIC_PATH pic_path, GALL_PIC_DESC pic_ket, POST_ID post_id', array('GALL_ID'=>$_uri_id));
	}
	/**
	 * get option + image (select2 bootstrap)
	 */ 
	 
	function get_option_template(){
		
		return $this->__select('mdl_gallery_pic  a', 'a.GALL_PIC_PATH pic, a.POST_ID id, a.GALL_PIC_NAME title',array('a.GALL_ID'=> 1));
	}
}
