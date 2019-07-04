<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * interface untuk menangkap variable berdasarkan post atau get
 * dan default akan mereturn 0
 * @param unknown $var
 */
function getVar($var='value'){

	$ci =& get_instance();

	if( isset($_POST[$var]) ) return $ci->input->post($var);

	elseif 	( isset($_GET[$var]) ) return $ci->input->get($var);

	else return 0;
}


function now_date(){
	$now = strtotime("now");
	return date('Y-m-d H:i:s',$now);
}

/**
 * http://indradhi.wordpress.com/2013/09/16/object-to-array/
 * by: indradhi nugraha mulyanto
 */

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

/**
 * tgl_to_your_format()
 * 
 * 2013-09-10 => 9 September 2013
 */ 

if(! function_exists('tgl')){

	function tgl($_tgl, $_mode=1){

		$_amode = array(1=>"d F Y", 2=>"d F Y G:i:s");

		return date ($_amode[$_mode], strtotime ($_tgl));
	}
}



/**
 * use to parsing url, get var or get seo url
 */ 
if(! function_exists('child_uri_pages')){

	function child_uri_pages($_uri = false){

		$_uri = str_replace(base_url(), '', full_url());

		$_uri = explode('/', $_uri);

		if($_uri[0] == 'pages') { 

			unset($_uri[0]);

			$_uri = array_values($_uri);
		}

		$c = 0;

		foreach($_uri as $var){

			if($var == '') unset($_uri[$c]);

			else if(strpos($var, '?') === 0 ) unset($_uri[$c] ); 

			$c++;
		}

		$_uri = array_values($_uri);

		return $_uri;
	}
}
/**
 * get full url at address bar
 * http://stackoverflow.com/questions/6768793/php-get-the-full-url
 */ 

if(! function_exists('full_url')){

	function full_url()	{

		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";

		$sp = strtolower($_SERVER["SERVER_PROTOCOL"]);

		$protocol = substr($sp, 0, strpos($sp, "/")) . $s;

		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	}
}


/**
 * generator pass word
 *  http://stackoverflow.com/questions/6101956/generating-a-random-password-in-php
 */ 

if( ! function_exists('gen_pass')){

	function gen_pass($_len = 5) {

		$alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuwxyz0123456789";

		$pass = '';

		$alphaLength = strlen($alphabet) - 1;

		for ($i = 0; $i < $_len; $i++) {

			$n = rand(0, $alphaLength);

			$pass .= $alphabet[$n];
		}
		return $pass;
	}
}

/**
 * untuk seo
 */ 

if ( ! function_exists('site_name'))
{	
	function site_name(){

		return reset( preg_split('/\//',  str_replace('http://', '', base_url()) ) );
	}
}

/**
 * 
 */
if ( ! function_exists('gen_option_html'))
{
	function gen_option_html($data=array(), $selected=0, $default=array()){

		$html = '';

		if(is_object($data) || is_array($data)){

			if(count($default) )$html = "<option value='".$default['id']."' ".($selected==$default['id'] ? 'selected':'' ).">".$default['title']."</option>\r\n";

			foreach ($data as $d){
				if(!is_array($d)) // if objek
					$html .= "<option value='".$d->id."' ".($selected==$d->id ? 'selected':'' ).">".$d->title."</option>\r\n";
				else {// array

					$html .= "<option value='".$d['id']."' ".($selected==$d['id'] ? 'selected':'' ).">".$d['title'] ."</option>\r\n";
					}

				//var_dump($d);
			}
		} else { // string json

			$opts = json_decode($data, true);

			foreach($opts as $opt=>$d) 

				$html .= "<option value='".$opt."' ".($selected==$opt ? 'selected':'' ).">".$d ."</option>\r\n";

		}

		return $html;
	}
}

/**
 * 
 */
if ( ! function_exists('html_loader'))
{
	function html_loader($url=false)
	{
		if(!$url) $url = base_url().'includes/img/loader.gif';
		return "<center><img src='{$url}'/></center>";
	}
}


/**
 * get class now or what in execute now
 */
if ( ! function_exists('current_module'))
{
	function current_module()
	{
		$CI =& get_instance();
		return $CI->router->fetch_module();
	}
}

/**
 * get class now or what in execute now
 */
if ( ! function_exists('current_class'))
{
	function current_class()
	{
		$CI =& get_instance();
		return $CI->router->fetch_class();
	}
}

/**
 * get function now or what in execute now
 */
if ( ! function_exists('current_function'))
{
	function current_function()
	{
		$CI =& get_instance();
		return $CI->router->fetch_method();
	}
}

/**
 * get option shortcode
 */ 
if ( ! function_exists('get_option'))
{
	function get_option($option)
	{
		$CI =& get_instance();
		return $CI->config->item($option);
	}
}

/**
 * mengecek apakah si login adalah admin
 */

if ( ! function_exists('is_login'))
{
	function is_login($param = 'user_id')
	{
		$CI =& get_instance();
		return $CI->session->userdata($param);
	}
}

/**
 * dapatkan nilai session dari variable
 */
if ( ! function_exists('get_session'))
{
	function get_session($var)
	{
		$CI =& get_instance();
		return $CI->session->userdata($var);
	}
}

/**
 * jika value tidak boleh kosong
 * maka gunakan fungsi ini
 */

if(! function_exists('if_empty'))
{
	function if_empty($val1, $val2=false)
	{
		return isset($val1) && strlen($val1) ? $val1 : $val2;	
	}
}
/**
 * inc_script: mengincludekan script langsung dengan list array 
 * 	files array (jquery.js, method.js, click.js ... )
 *  line =  <script language="JavaScript" type="text/javascript" src="#__"></script>
 *  


if(! function_exists('inc_script'))
{
	function inc_script($files = array(), $line='<script language="JavaScript" type="text/javascript" src="#__"></script>', $method='includes', $replace='#__')
	{
		$script = '';
		foreach($files as $f){
			$path = $method().$f;
			$script .= str_replace($replace, $path, $line)."\r\n";
		}
		return $script;
	}
}
 */
/**
 * inc_script(array('script.js', 'style.css'))
 */ 
if(! function_exists('inc_script'))
{
	function inc_script($files = array(), $method=null, $line= array(), $replace='#__')
	{
		
		$ext_array = array(
			'js'=>'<script language="JavaScript" type="text/javascript" src="#__"></script>',
			'css'=>'<link rel="stylesheet" type="text/css" href="#__" />'
		);
		
		$line_is_array = false;
		
		#if(is_array($line)) { 
		if(count($line)) { 
			$ext_array = array_merge($line, $ext_array);
			$line_is_array = true; 
		} 
		
		$script = '';
		
		if($method===null) $method = '';
		
		$CI =& get_instance();
		$metode = $CI->config->slash_item('base_url').$method.'/';
		$metode = str_replace('//', '/', $metode);
		$metode = str_replace('http:/', 'http://', $metode);
		
		foreach($files as $f){
			$path = $metode.$f;
			$_tmp = preg_split('/\./', $f);
			$ext = end($_tmp);
			$line = $ext_array[$ext];
			$script .= str_replace($replace, $path, $line)."\r\n";
		}
		return $script;
	}
}

/**
 * code asal dari inspira helper madein indradhi
 * code pengembangan inspira helper madein g3n1k
 */

if ( ! function_exists('includes'))
{
	function includes()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'includes/';
	}
}

if ( ! function_exists('template_dir'))
{
	function template_dir()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template');
	}
}


if ( ! function_exists('template_css'))
{
	function template_css($css = 'css')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template').$css;
	}
}

if ( ! function_exists('admin_css'))
{
	function admin_css($css = 'css')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('admin_template').$css;		
	}
}

if ( ! function_exists('template_js'))
{
	function template_js($js = 'js', $admin=false)
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template').$js;
	}
}

if ( ! function_exists('admin_js'))
{
	function admin_js($js = 'js')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('admin_template').$js;
	}
}

if ( ! function_exists('template_img'))
{
	function template_img($img = 'img')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template').$img;
		//if(!$CI->admin) return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template').$img;
		//else return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('admin_template').$img;
	}
}

if ( ! function_exists('admin_img'))
{
	function admin_img($img = 'img')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('admin_template').$img;
	}
}

if ( ! function_exists('template_fonts'))
{
	function template_fonts($fonts, $admin=false)
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('template').$fonts;
	}
}

if ( ! function_exists('admin_fonts'))
{
	function admin_fonts($fonts = 'fonts')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').'templates/'.$CI->config->slash_item('admin_template').$fonts;
	}
}



/** 
 *  to_uri ubah string title menjadi uri -> seo friendly
 */
if ( ! function_exists('to_uri'))
{
	function to_uri($str)
	{
		$str = preg_replace('~[^A-Za-z\d\s-]+~u', ' ', $str);
		$str = preg_replace('!\s+!', ' ', $str);
		$str = str_replace(' ','-', strtolower($str));
		return $str;
	}
}

/**
	nyontek indradhi, return string path
*/
if ( ! function_exists('dir_apps'))
{
	function dir_apps($path_apps = null)
	{
		$CI =& get_instance();
		if(!$path_apps) $path_apps = 'cms/plugin';
		return $CI->config->slash_item('base_url').$path_apps;
	}
}

/**
change br ke newline
*/
if(! function_exists('br2nl')){
	function br2nl($html){
		//$html = 'this <br>is<br/>some<br />text <br    />!';
		$nl = preg_replace('#<br\s*/?>#i', "\n", $html);
		return $nl;
	}
}

//ini fungsi untuk paging data tanpa melalui paging database    
if ( ! function_exists('get_display_data'))
{
    function get_display_data($data, $currentpage, $rowperpage, $rowcount)
    {
        $numrowperpage = $rowperpage;
        $numrowtotal = $rowcount;
        $num_page = ceil($numrowtotal/$numrowperpage);
        if($num_page < $currentpage) $currentpage = $num_page;
        if($currentpage == 0) $currentpage = 1;
        $myoffset = $rowperpage * ($currentpage - 1);
        
        $array_data = array();
        $num_display = (($rowcount-$myoffset) < $rowperpage) ? ($rowcount-$myoffset) : $rowperpage;
        
        for($i=$myoffset; $i<($myoffset+$num_display); $i++)
        {
            array_push($array_data, $data[$i]);
        }
        
        //return $array_data;
        
        $array = array('result' => $array_data,
                        'rowcount' => $rowcount,
                        'currentpage' => $currentpage,
                        'rowperpage' => $rowperpage);
        return $array;
    }
}

if ( ! function_exists('json_encode2'))
{
  function json_encode2($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode2($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode2($k).':'.json_encode2($v);
      return '{' . join(',', $result) . '}';
    }
  }
  
}

function tgl_ml($tgl){
	$tanggal = strtotime($tgl);
	return date("Y-m-d H:i", $tanggal);
}

//tambahan kerimit
    function execute_curl_post($url,$data)
    {
        $data_string = json_encode($data);                                                                                   
        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('cache-control: no-cache', 'Content-Type: application/json; charset=utf-8','Content-Length: ' . strlen($data_string), 'postman-token: b58902b0-d09d-8116-21fe-fdee15bf9e42' ));                                                                                                                   
        $result = curl_exec($ch);            
        return $result;
    }

    function execute_curl_get($url)
    {
        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                  
        $result = curl_exec($ch);            
        return $result;
    }
