<?php
/**
 * 
 * @author g3n1k
 * penyempurnaan untuk library Shortcodes
 * untuk pembacaan spasi dan pemasangan parameter
 */
class GW_Modules extends Modules {
	
	/**
	 * @param unknown_type $module
	 * hampir sama dengan run di Modules
	 */
	public static function run($string) {
		#foo/testfoo/test 1,"dua",'tiga',true
		
		$module_param = explode(',', $string);
		
		$module = $module_param[0];
		
		unset($module_param[0]);
		
		$module_param = array_values($module_param);
		
		$length = count($module_param);
		
		$ary = array();
		
		for($i=0; $i<$length; $i++) { 
			//$module_param[$i] = substr(strstr($module_param[$i]," "), 1);
			$module_param[$i] = ltrim(rtrim($module_param[$i]));
			//dump($module_param[$i]);
		}
		
		//$param = preg_replace("/,([\s])+/",",",implode(',',$module_param));
		$param = preg_replace('/\s*,\s*/', ',',implode(',',$module_param));
		
		//dump($param);
		
		//die(var_dump($str));
		$method = 'index';
		
		if(($pos = strrpos($module, '/')) != FALSE) {
			$method = substr($module, $pos + 1);
			$module = substr($module, 0, $pos);
		}
		
		if($class = self::load($module)) {
				
			if (method_exists($class, $method))	{
				ob_start();
				$output = call_user_func_array(array($class, $method), explode(',',$param));
				$buffer = ob_get_clean();
				return ($output !== NULL) ? $output : $buffer;
			}
		}
		
		log_message('error', "Module controller failed to run: {$module}/{$method}");
	}
}
