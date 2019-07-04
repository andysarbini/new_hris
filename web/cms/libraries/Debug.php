<?php if ( ! defined ( 'BASEPATH' ) ) exit ( 'No direct script access allowed.' );
/**
* @author Indra Sadik <indra.sadik@gmail.com>
* @copyright Copyright (c) 2012, Indra Sadik, G3n1k
* @version 0.1
*/
class Debug  extends CI_Controller {
	
	static function log($msg, $log='log'){
		
		$handle = fopen( BASEPATH . "../logs/debug.log", "a+");
		
		fwrite($handle, "\r\n ".date("Y-m-d H:i:s")." {$log} : ".$msg);
	}
}
