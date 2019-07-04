<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * 
 */
class API_Controller extends MX_Controller
{
	public function __construct() {
		parent::__construct();	
	}
	
	/**
	 * tipe data dikeluarkan, kita bisa menambahkan nya disini
	 * @param unknown $data 
	 * @param string $method
	 * @return unknown
	 */
	function __out($data, $method = 'return'){
	
		switch ($method){
			case 'echo': echo $data; break;
				
			case 'json' : echo json_encode($data);
				
			case 'return' : default: return $data;
		}
	}
	
	function ping(){
		
		echo 'ping hello world';
	}
}