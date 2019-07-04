<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * this class use to get array combination
 * @author Tom Butler
 * source http://r.je/php-find-every-combination.html
 * @coder g3n1k
 * 
 * to produce array which have combination
 * 
 */
class combination extends MX_Controller {
	
	function get($words=array('red','green','blue')){
		
		// store all array combination
		$aray = array();
		
		$num = count($words);
		
		//The total number of possible combinations
		$total = pow(2, $num);
		
		//Loop through each possible combination
		for ($i = 0; $i < $total; $i++) {
			
			// reset array
			$cell = array();
			
			for ($j = 0; $j < $num; $j++) {
				//Is bit $j set in $i?
				if (pow(2, $j) & $i) array_push($cell, $words[$j]);
			}
			
			$aray[] = $cell;
		}
		
		unset($aray[0]);
		
		return $aray;
	}
}