<?php
/**
 * 
 * @author g3n1k
 * class ini untuk mendapatkan nilai previous dan next dari database
 * 
 */
class prevnext {
	
	private $_table; // table tujuan
	
	private $_column_in; // column yang akan di jadikan acuan 'URI' 'uri-url-seo'
	
	private $_column_out; // value column yang di outputkan : 'URI'
	
	private $_column_id; // column counter / primary key (int, autoincrement ?): ID
	
	private $_value;
	
	private $_where = array(); // mungkin ada query lain : ACTIVE => 1
	
	private $ci; // codeigniter instance
	
	private $_id; // id now
	/**
	 * init 
	 * @param string $_table
	 * @param string $_column_in
	 * @param string $_column_out
	 * @param array $_where
	 * 
	 * example:
	 * 
	 * 	$this->load->library('prevnext');
	 *
	 *	$this->prevnext->set('mdl_content', 'POST_URI', 
	 * 		'POST_URI', 'POST_ID', $_id_uri, 
	 * 		array('POST_ISACTIVE'=>1, 'POST_CATEGORY'=>4));
	 *
	 *	$data['_next'] = $this->prevnext->next();
	 *
	 * 	$data['_prev'] = $this->prevnext->prev();
	 * 
	 */
	public function set($_table=false, $_column_in=false, $_column_out=false,  $_column_id=false, $_value=false, $_where=array()){
		
		if($_table) $this->_table = $_table;
		
		if($_column_in) $this->_column_in = $_column_in;
		
		if($_column_out) $this->_column_out = $_column_out;
		
		if($_column_id) $this->_column_id = $_column_id;
		
		if($_value) $this->_value = $_value;
		
		if(count($_where)) $this->_where = $_where;
		
		//die(var_dump($this->_where));
		
		$this->ci = &get_instance();
		
		$this->_id = $this->db_get_id_now();
		
	}
	
	/**
	 * give next value
	 */
	public function next(){
		
		$_c_out = $this->_column_out;
		
		$this->ci->db->select($_c_out)->from($this->_table);
		
		if(count($this->_where)) foreach( $this->_where as $var=>$val) $this->ci->db->where($var, $val);
		
		$this->ci->db->where($this->_column_id .' >', $this->_id)->limit(1);
		
		$_query = $this->ci->db->get();
		
		//return @$_query->row()->$_c_out;
		return @$_query->row();

	}
	
	public function prev(){

		$_c_out = $this->_column_out;
		
		$this->ci->db->select($_c_out)->from($this->_table);
		
		if(count($this->_where)) foreach($this->_where as $var=>$val) $this->ci->db->where($var, $val);
		
		$this->ci->db->where($this->_column_id .' <', $this->_id);
		
		$this->ci->db->order_by($this->_column_id, 'DESC');
		
		$this->ci->db->limit(1);
	
		$_query = $this->ci->db->get();
		
		//return @$_query->row()->$_c_out;
		return @$_query->row();
	}
	
	private function db_get_id_now(){
		
		//die(var_dump($this->_where));
		
		$_c_id = $this->_column_id;
		
		$this->ci->db->select($_c_id)->from($this->_table);
		
		if(count($this->_where)) foreach($this->_where as $var=>$val) $this->ci->db->where($var, $val);
		
		$this->ci->db->where($this->_column_in, $this->_value);
		
		$this->ci->db->limit(1);
		
		$_query = $this->ci->db->get();
		//	echo 'get id now :'.$this->ci->db->last_query();
		//	var_dump($_query->row());
		return $_query->row()->$_c_id;
	}
}
