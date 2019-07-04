<?php
/**
 * status:experimental
 * createdate:27 Januari 2013
 * version:0.1
 * by:g3n1k@yahoo.com
 * desc:library ini digunakan untuk akomodasi dari system MVC yang berubah menjadi HMVC
 * karena HMVC cari wiredesign memiliki kelebihan untuk mengeksekusi 
 * 
 * modules::run('module/controller/method', $params, $...);
 * modules::run('module/method', $params, $...);
 * modules::run('module', $params, $...);
 * 
 * terinspirasi pada shortcode nya plugin wordpress
 * fork:http://codeigniter.tv/a-6/Create-a-Codeigniter-Wordpress-like-shortcode-parser
 * 
 * 
 * format short code = [sc:module/controller/function param1_number,'param2_string',param_n]
 * note ada spasi antara function dengan param_1
 * 
 * ----------------------------------------------------------------------
 * update 24 Febuari 
 * penambahan pembacaan reqursif
 * 
 */ 

if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * class untuk shorcodes
 */
class Shortcodes
{

	static public function parse ($str, $depth=0, $max_depth=3)
    {
        // Check for existing shortcodes
        if (! strstr($str, '[sc:')) return $str;
        
         // Find matches against shortcodes like [sc:module/controller/function,param_1,param_2,param_n]
        preg_match_all('/\[sc:([a-zA-Z0-9-_\/ \,\"\']+)]/i', $str, $shortcodes);
        
        if ($shortcodes == NULL) return $str;
        
        // get run the class method and param
        foreach($shortcodes[1] as $key=>$sc) {
			
			 $string =  GW_Modules::run($sc);
			 
			 if(strstr($string, '[sc:') && $depth < $max_depth) $string =  self::parse($string, ++$depth);
			 
			 $shortcode_array[] = $string;
		}
        
        // Return the entire parsed string
        return str_replace($shortcodes[0], $shortcode_array, $str);
        
    }

}
