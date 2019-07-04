<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends MX_Controller {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model('api_m');
		
		$this->load->model('foo/foo_m');
	}
	
	public function index(){
		echo 'hello from ' . current_class();
		
	}
	/**
	 * get select option
	 * @param string $table
	 * @param string $query
	 * 
	 * or you can query = array('id'=>'name_column_id', 'title'=>'name_column_title')
	 */
	public function select($table = '', $query = '', $where=array()){
		
		$str = $query;
		
		if(is_array($query)) {

			$str = '';
			
			$counter = 1;
			
			foreach($query as $var=>$val) {

				$str .= ( $counter > 1 ? ',':'') . $val . ' ' . $var; 
				
				$counter++;
			}
		}
		
		return $this->api_m->__select($table, $str, $where);
	}
	
	public function load_view($_path='provkab'){
		return $this->load->view($_path);
	}
	
	public function title($_table, $_column_title, $_where = array()){
		$t = $this->api_m->__select($_table, $_column_title.' title', $_where, false);
		return $t->title;
	}
	
	public function options($var = ''){
		
		$t = $this->api_m->__select('mdl_options', 'OPT_VAL val', array('OPT'=>$var), false);
		return @if_empty($t->val,'');
	}
	
	public function options_title($selected=0, $var){
		
		$json = $this->foo_m->__select('mdl_options', 'OPT_VAL val', array('OPT'=>$var), false);
		
		$t 	= json_decode($json->val);
		
		return $t->$selected;
	}
	
	// unutk acl biar lebih pendek, maka harus di deklarasi disini
	# ini jelek banget
	public function acl($group_id, $module_name){
		$this->load->model('acl/acl_m');
		$acl = $this->acl_m->acl($group_id, $module_name);
		
		return array(
				'view'=>(int)@if_empty($acl->v, 0), 
				'insert'=>(int)@if_empty($acl->i, 0),
				'update'=>(int)@if_empty($acl->u, 0),
				'delete'=>(int)@if_empty($acl->d, 0)
			
		);
	}
}
