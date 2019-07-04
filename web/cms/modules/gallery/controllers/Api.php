<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends API_Controller {
	
	private $_col = array(
			'id'=>'GALL_PIC_ID',
			'gall_id'=>'GALL_ID',
			'gall_name'=>'GALL_NAME',
			'gall_uri'=>'GALL_URI',
			'name'=>'GALL_PIC_NAME',
			'uri'=>'GALL_PIC_URI',
			'path'=>'GALL_PIC_PATH',
			'description'=>'GALL_PIC_DESC'
	);
	
	private $_tbl = 'vw_mdl_gallery_pic_user_group';
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model('gallery_m');
	}
	
	/**
	 * ambil semua image berdasarkan jenis/id gallery tertentu
	 * @param unknown $iduri
	 * @param string $out
	 * @return unknown
	 */
	function allPicFromGallery($p){
		
		$param = array(
				'order_by' => false, // COL_COL=>desc =>
				'limit' => 0, // 10,2 =>
				'out' => 'return', // api . __out
				'where' => false, // aray('COL_TABLE'=>value)
				'column' =>false
		);
		
		if(!$p) $p = getVar('param'); // get from input
		
		else $p = !is_array($p) ? json_encode($p, true): $p;
		
		$param = array_merge( $param, $p);
		
		//dump_exit($param, 'param@api');
		
		$a_select = $this->_col;
		
		if(!$param['column'] && $param['column'] !== false) {
				
			$a_select = array();
				
			if(!is_array($param['column'])) $param['column'] = explode('', explode(',', preg_replace("/[^0-9,]/","",$param['column'])));
				
			foreach($param['column'] as $val) $a_select[$val] =  $this->_col[$val];
		}
		
		$select = $this->gallery_m->__gen_query_select($a_select);
		
		$this->gallery_m->db->select($select);
		
		$this->gallery_m->db->from($this->_tbl);
		
		// where
		if($param['where']) {
			
			if(!is_array($param['where'])) $param['where'] = json_decode($param['where'], true);
				
			foreach( $param['where'] as $val=>$var ) $this->gallery_m->db->where($this->_col[$val], $var);
			}
		
			// limit
			if($param['limit']){
				
			if(!is_array($param['limit']))
				$param['limit'] = explode(',', preg_replace("/[^0-9,]/","",$param['limit']));
					
				if(count($param['limit']) > 1)
				$this->gallery_m->db->limit($param['limit'][0], $param['limit'][1]);
					
				else $this->gallery_m->db->limit($param['limit'][0]);
			}
		
			// order_by
			if($param['order_by']){
					
				foreach($param['order_by'] as $var=>$val) $this->gallery_m->db->order_by($this->_col[$var], $val);
			}
		
			$query = $this->gallery_m->db->get();
			
			// if just one	
			$result = ($param['limit'][0] == 1 || $param['limit'][0] == '1') ? 'row' : 'result'; 
			
			return $this->__out($query->$result(), $param['out']);
	}
}