<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class options extends GW_Admin {
	
	private $_prime_table = 'mdl_options';
	
	private $_prime_query = 'OPT_ID id, OPT opt, OPT_VAL val,OPT_ACTIVE acc';
	
	private $_module;
	
	public function __construct(){
		
		parent::__construct();
		
		$this->_module = current_module();
		
		$this->load->model('foo/foo_m');
	 }
	 
	
	function index(){
		
		redirect_404();
	}
	
	function get($kls=false){
		
		return $this->foo_m->__select($this->_prime_table, $this->_prime_query, array('KLS'=>$kls), false);
	}
	
	function simpan($data = array()){
		
		foreach($data as $var=>$val){
			
			$cek = $this->foo_m->__select($this->_prime_table, '*', array('OPT'=>$var));
			
			if(count($cek)) $this->foo_m->__update($this->_prime_table, array('OPT'=>$var,'OPT_VAL'=>$val), array('OPT'=>$var));
			
			else $this->foo_m->__insert($this->_prime_table, array('OPT'=>$var,'OPT_VAL'=>$val));
		}	
	}
	
	function hapus($_id = false){
		
		$this->foo_m->__delete($this->_prime_table, array('KLS_ID'=> $_id));
		
		redirect(base_url().'admin/'.$this->_module);
	}
}
