<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _content extends API_Controller {
	
	private $col_content = array(
			'id'=>'POST_ID',
			'title'=>'POST_TITLE',
			'uri'=>'POST_URI',
			'title_short'=>'POST_TITLE_SHORT',
			'description'=>'POST_DESCRIPTION',
			'name'=>'USR_NAME_INPUT',
			'tgl'=>'POST_INPUT_DATE',
			'cat_title'=>'CAT_TITLE',
			'cat_uri'=>'CAT_URI',
			'content'=>'POST_CONTENT',
			'active'=>'POST_ISACTIVE',
			'feature_img'=>'POST_FEATURE_IMAGE'
	);
	
	private $tbl_content = 'vw_mdl_content_user_group';
	
	function __construct(){

		parent::__construct();
		
		$this->load->model('content/content_m');
	}
	
	/**
	 * mendapatkan semua title dari table category
	 * @param string $category
	 * @param string return $out = string, ajax, array, object
	 */
	function allTitleFromCategory($category=false, $out = 'return'){
		
		if(!$category) $category = getVar('category');
		
		$select = $this->content_m->__gen_query_select($this->col_content);
		
		$data = $this->content_m->__select($this->tbl_content, $select, array('CAT_URI'=>$category));
		
		return $this->__out($data, $out);
	}
	
	/**
	 * dapatkan content dari tbl content
	 * @param string $count (single / multiple)
	 * @param unknown $iduri
	 */
	function getContent($iduri=false, $path_views='show_just_content', $out='echo', $debug=true){
		
		$this->load->model('api_m');
		
		if(!isset($iduri) || !$iduri) $iduri = getVar('iduri');
		
		$select = $this->api_m->__gen_query_select($this->col_content);
		
		if(!is_numeric($iduri)) $where = array('POST_URI'=>$iduri);
		
		else $where = array('POST_ID'=>$iduri);
			
		$data = $this->api_m->__select($this->tbl_content, $select, $where, false);
		
		if($out == 'return') return $this->__out($data, $out);
		
		else echo $this->load->view($path_views, array('content'=>$data), true);//dump($data, 'data'); 
		
	}
	
	/**
	 * dapatkan data content berdasarkan kategori tertentu
	 * dapat di sortir berdasarkan column (asc, desc)
	 * dapat di dapat di pilah beberapa data
	 */
	function getListContent($p = false){
		
		$param = array(
			'order_by' => false, // COL_COL=>desc =>
			'limit' => 0, // 10,2 => 
			'out' => 'return', // api . __out
			'where' => false, // aray('COL_TABLE'=>value)
			'like' => false, // active record like, Array()
			'column' =>false,
			'debug' => false
		);
		
		if(!$p) $p = getVar('param'); // get from input
		
		
		else $p = !is_array($p) ? json_encode($p, true): $p;
		
		$param = array_merge( $param, $p);
		
		if($param['debug']) $this->load->libraries('Debug');
		
		$a_select = $this->col_content; 
		// column
		if($param['column'] && $param['column'] !== false) { 
			
			if($param['debug']) Debug::log('in column','param column');
			
			$a_select = array();
			
			if(!is_array($param['column'])) $param['column'] =explode(',', preg_replace("/[^0-9,]/","",$param['column']));
			
			foreach($param['column'] as $val) $a_select[$val] =  $this->col_content[$val];
		}
		
		$select = $this->content_m->__gen_query_select($a_select);
		
		$this->content_m->db->select($select);
		
		$this->content_m->db->from($this->tbl_content);
		
		// where
		if($param['where']) {
			
			if(!is_array($param['where'])) $param['where'] = json_decode($param['where'], true);  
			
			foreach( $param['where'] as $val=>$var ) $this->content_m->db->where($this->col_content[$val], $var);
		}
		
		// like
		/*
		$p = array(
				
			'like'=>array(
				'match'=>$s,
				'field'=>array(
					'title','uri','title_short','description','cat_title','cat_uri','content'
				),
				'wildcard'=>'after'				
			)
		);
		 */
		if($param['like']){
			// default param for like
			$p_like = array(
				'wildcard'=>'after'
			);
			// merge option 
			$param['like'] = array_merge($p_like, $param['like'] );
			
			foreach($param['like']['field'] as $field) 	
				$this->content_m->db->or_like($this->col_content[$field], $param['like']['match'], $param['like']['wildcard']);
		}
		
		// limit
		if($param['limit']){
			
			if(!is_array($param['limit'])) 
				$param['limit'] = explode(',', preg_replace("/[^0-9,]/","",$param['limit']));
			
			if(count($param['limit']) > 1)
				$this->content_m->db->limit($param['limit'][0], $param['limit'][1]);
			
			else $this->content_m->db->limit($param['limit'][0]);
		}
		
		// order_by
		if($param['order_by']){
			
			foreach($param['order_by'] as $var=>$val) $this->content_m->db->order_by($this->col_content[$var], $val);
		}
		
		$query = $this->content_m->db->get();
		
		if($param['debug']) {
			Debug::log($this->content_m->__last_query(), 'query');
			Debug::log($param['column'], 'param_column');
			Debug::log('true', 'gw ganteng');
		}
		
		return $this->__out($query->result(), $param['out']);
	}
}
