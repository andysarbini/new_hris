<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * untuk mendapatkan rows rows yang berelasi dengan param-param
 * @author g3n1k
 * contoh kasus: 
 * user A mengklik detail sebuah property (bangunan)
 * bangunan itu ada di jakarta, jakarta barat, tipe nya rumah, jenis nya rent_buy nya jual
 * dari sini kita bisa ambil parameter jakarta, jakarta barat, tipe, jual
 * query adalah select rumah dll 
 * 
 * @date 13.12.2013 11:43:04
 * 
 * version 0.1 
 */
class related extends MX_Controller {

	var $query; // query ditampung disini
	
	var $where; // where array input
	
	var $max = 10; // jumlah maximal yang didapatkan dalam related	
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->model('api_m');
	}
	
	/**
	 * ini akan melakukan seting parameter array
	 * @param unknown 
	 * 	$param_aray = array(
	 * 		'query'=>'select*from table #where#', 
	 * 		'where'=>array('red=1','green < 2','blue like "%sky%"')
	 * 		'max'=>5
	 * );
	 */
	private function set_param($param_aray = array()){
		
		foreach($param_aray as $var=>$val){

			$this->$var =  $val;
		}
	}
	
	/**
	 * mendapatkan hasil related
	 */
	function get($param_aray = array()){
		
		$this->set_param($param_aray);
		
		// get combination array 
		$combination = Modules::run('api/combination/get', $this->where);
		
		// sorting to higher
		$combination = $this->short_aray($combination);
		
		$rows = array();
		
		foreach($combination as $aray=>$val){
			
			$where = implode(' and ', $val);
			
			if($where)  $where = ' where ' . $where; 
			
			$query = str_replace('#where#', $where, $this->query);
			
			$result = $this->api_m->__query($query);
			
			if(count($result) && $result!= false){
				
				// sudah ada isi nya -> masukan setiap hasil query ke rows
				if(count($rows) && $rows!= false) foreach($result as $r) $rows[] = $r;
				
				else $rows = $result; 
			}
			
			if(count($rows) >= $this->max) break;
		}
		
		
		return $this->get_unique_array($rows,'id',true);
	}
	
	/**
	 * menghilangkan aray yg memiliki unique_key yg sama
	 * 
	 * gunakan ini karena array_unique tidak dapat mengunique kan array yang berisi object/array
	 * 
	 * @param unknown $aray
	 * @param string $unique_key
	 * @param string $isobject
	 * @return multitype:unknown
	 */
	function get_unique_array($aray = array(), $unique_key=false,$isobject=true){
		
		$unique_key	= ($unique_key) ? $unique_key : if_empty($this->unique_key,'id');
		
		$unique_value = array(); // save unique value
		
		$unique = array(); // dump data unique
		
		// cari unique value
		foreach ($aray as $var=>$val) {
			
			$value = $isobject ? $val->$unique_key : $val[$unique_key];
			
			// jika sudah ada di unique value -> remove 
			if(!in_array($value, $unique_value)){
				
				$unique_value[] = $value; // update dulu
				
				$unique[] = $val;
			}
			
		}
		
		return $unique;
	}
	
	/**
	 * melakukan shorting array dari hasil kombinasi
	 * di sorting dari yang memiliki kombinasi terpanjang
	 * @param unknown $aray
	 * @return number|unknown
	 */
	function short_aray($aray = array()){
		
		function short_aray_length($a, $b){
			
			$ca = count($a); 

			$cb = count($b); 
			
			if( $ca == $cb) return 0;
			
			return ($ca < $cb) ? 1 : -1;
		}
		
		usort($aray, 'short_aray_length');
		
		return $aray;
	}
	
	/**
	 * n kita test
	 */
	function test(){
		
		$param['query'] = "select p.PRO_ID id,p.PRO_TITLE title, p.PRO_TYPE type from mdl_property p #where# and p.PRO_ID<>1";
		
		$param['where']= array('p.PROV_KODE=31', 'p.KAB_KODE=73');
		
		$result = $this->get($param);
		
		dump($result);
	}
	
}

