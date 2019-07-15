<?php defined('BASEPATH') OR exit('No direct script access allowed');





class GW_Model extends CI_Model {

//    function __construct() {    }

	/**
	 * which column have other name array('title'=>'PRX_TITLE')
	 * @param column array,
	 * @param method string 'post' or 'get'
	 * 2014/02/25 05:49:04  <g3n1k@n43s>
	 */
	function __input_to_aray_column($column, $method = 'post'){

		$var_input = (strtolower($method) === 'post') ? $_POST : $_GET;

		$a = array();

		foreach($var_input as $var=>$val) if( array_key_exists($var, $column) ) $a[$column[$var]] = $this->input->$method($var);

		return $a;
	}


	/**
	 *
	 * @param string $_table
	 * @param array $_data param
	 */
	public function __delete($_table = false, $_data = array()){

		if($_table && count($_data)) {

			$this->db->delete($_table, $_data);
			//echo $this->db->last_query();
			return $this->db->affected_rows();

		}
	}

	/**
	 *
	 * @param string $_table
	 * @param array $_data param
	 */
	public function __insert($_table, $_data = array()){

			$this->db->insert($_table, $_data);
		//	echo $this->db->last_query();
			return $this->__lastid();
	}

	public function __insert_batch($_table, $_data = array()){

		$this->db->insert_batch($_table, $_data);
	}

	/**
	 *
	 * @param string $_table
	 * @param array $_data
	 * @param array $_where
	 *
	 */
	public function __update($_table = false, $_data = array(), $_where){
		$this->db->update($_table, $_data, $_where);
		//echo $this->db->last_query();
		return $this->db->affected_rows();
	}

	public function __lastid() {

		return $this->db->insert_id();

	}
	/**
	 * @param string $_table
	 * @param string $_select
	 * @param array $_where
	 * @param boolean $_result true return data result else data row 
	 */
	public function __select( $_table = false, $_select = '*', $_where = array(), $_result = true ){

		$this->db->select($_select);

		$this->db->from($_table);

		// jika where adalah array
		if (is_array($_where) && @count($_where)  ) foreach ($_where as $var=>$val)	$this->db->where($var, $val);

		// jika where adalah string
		else $this->db->where($_where);
		
		$query  = $this->db->get();

		debug($this->db->last_query());
		
		//return $_result ? $query->result() : $query->row();

		if($_result == true) return $query->result();

		if($_result == false) return $query->row();

		else return $query->$_result();
	}

	public function __error(){

		return 'error no '.$this->db->_error_number().' :'.$this->db->_error_message();
	}

	/**
	 * count jumlah record di table content
	 */
	function __count($_table = false, $_where = array()){

		$this->db->select('count(1) jumlah');

		$this->db->from($_table);

		if(count($_where)) foreach($_where  as $var=>$val) $this->db->where($var, $val);

		$query = $this->db->get();

		#dump($this->db->last_query());

		return $query->row()->jumlah;
	}

	function __query($q = false, $method = 'result'){
		$query = $this->db->query($q);
		return @$query->$method();
	}

	/**
	 * this for generate query select from array dbfield
	 * @param array $data
	 * @return string => FIELD_1 field1, FIELD_2 field2
	 */
	function __gen_query_select($data=array(), $table=false){

		$ary = array();

		$table = $table ? $table.'.' : '';

		foreach($data as $var=>$val) $ary[] = "{$table}{$val} {$var}";

		return implode(',', $ary);
	}
	/**
	 * return query from last transaction
	 */
	function __last_query(){

		return $this->db->last_query();
	}

	function _generate_code($_table, $_field, $_where = array(), $_digit, $_prefix){

		$_substr = 'SUBSTR('.($_field).', -'.$_digit.')';

		$this->db->select_max($_substr,'code');

		$this->db->from($_table);

		if(count($_where)) foreach($_where  as $var=>$val) $this->db->where($var, $val);

		$query = $this->db->get();

		$_max_code = $query->row()->code;

        return $this->format_code($_max_code, $_prefix, $_digit);

	}

	function format_code($_max_code, $_prefix, $_digit){

		$_max_code = $_max_code + 1;

		$_zero = '00000';

		$_jmlh_digit = strlen($_max_code);

		$_code = $_prefix.substr($_zero,$_jmlh_digit,($_digit-$_jmlh_digit)).$_max_code;

		return $_code;	}
}

