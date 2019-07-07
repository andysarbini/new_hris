<?php if ( ! defined ( 'BASEPATH' ) ) exit ( 'No direct script access allowed.' );
/**
* @author Indra Sadik <indra.sadik@gmail.com>
* @copyright Copyright (c) 2012, Indra Sadik, G3n1k
* @version 0.1
*/
class image { #disable this library
	
	var $ci;
	
	function __construct(){
		
		$this->config();
		
		$this->ci = &get_instance();
		
		$this->ci->load->library('image_lib');
	}
	
	// ---------------------- version 0.02 ci using image lib
	/**
	 * set array config for image manipulation
	 * set default config array, 
	 * get config array
	 * then merge it
	 */
	
	private $cfg = array(
			'image_library'=>'gd2',
			'create_thumb'=>true,
			'maintain_ratio'=>true,
			'width'=>250,
			'height'=>250
			
		);
	
	function config( $cfg = array() ){
		
		$this->cfg = array_merge($this->cfg, $cfg);
		
		$this->cfg['thumb_marker'] = '_'.$this->cfg['width'].'x'. $this->cfg['height'];
	}
	// ================= new 2013 development
	/**
	 * 
	 * jika file asli nya 
	 * base_url / uploads/gallery/xxx/images_gw.jpg
	 * 
	 * file resize nya
	 * base_url / uploads/gallery/xxx/images_gw_250x250.jpg
	 * 
	 * base_url to path
	 * 
	 */
	function resize($path_img){
		
		
		$ary = $this->pathnameext($path_img);

		$thumb 	= $ary['path'] . '/' . $ary['name'] . $this->cfg['thumb_marker'] .'.'. $ary['ext'];
		#var_dump($thumb);
		$url	= $ary['url'] . '/' . $ary['name'] . $this->cfg['thumb_marker'] .'.'. $ary['ext'];
		#var_dump($url);
		if(file_exists($thumb)) return $url;
		
		else {
			
			$this->cfg['source_image'] 	= $ary['path'] . '/' . $ary['name'] .'.'. $ary['ext'];
			
			$this->ci->image_lib->initialize($this->cfg);
			
			if($this->ci->image_lib->resize()) return $url;
				
			else return $this->ci->image_lib->display_errors();
		}
		
		
	}
	
	function pathnameext($filename)
	{
		
		$tmp = explode('.',$filename);
		$jml = count($tmp);
	
		$ary['ext'] = $tmp[$jml-1];
	
		unset($tmp[$jml-1]);
		$filename = implode('.',$tmp);
	
		$tmp2 = explode('/', $filename);
		$jml = count($tmp2);
	
		$ary['name'] = $tmp2[$jml-1];
		unset($tmp2[$jml-1]);
		
		$ary['url']	= implode('/', $tmp2);
		
		/** dapatkan path untuk resize **/
		$path 			= str_replace(base_url(), '', $filename);
		$path			= explode('/',$path);
		array_pop($path);
		$path			= implode('/', $path);
		$base_path 		= str_replace('/'.SYSDIR, '', BASEPATH);
		$ary['path'] 	= $base_path . $path;
	
		return $ary;
	}
	
	/* =====================================
	function resize( $cfg = array() ){
		
		if( count($cfg) ) $this->config( $cfg );
		
		if( ! isset($this->cfg['source_image']) ) die('the source_image not set');
		
		$ci = &get_instance();
		
		// start -- create your modification here
		
		// stop
		
		$ci->load->library('image_lib', $this->cfg);
		
		if ( ! $ci->image_lib->resize())
		{
			die( 'error @ resize image: '.$ci->image_lib->display_errors());
		}
	}
	/**/
	// ---------------------- version 0.01 full php function
	
	function set($filename, $width = 250, $height = 170){
		if(!file_exists($filename))
			return resize2jpg($filename, $width, $height);
		else 
			return $filename;
	}
	
	function up2jpg($filename, $width = 250, $height = 170){
		list($w, $h) = getimagesize($filename);
		
		// dapatkan nama, path, ext
		$pne = $this->pathnameext($filename);
		
		// source by ext
		switch($pne['ext']){
			case 'gif':
				$source = imagecreatefromgif($filename);
			break;
			case 'png':
				$source = imagecreatefrompng($filename);
			break;
			default:
				$source = imagecreatefromjpeg($filename);
			break;		
		}
		
		// jika
		if($width != 0 or $height != 0){ // 0 = no resize
			
			if($w > $h) // lebar
			{
				$rasio = $width / $w;
				$new_w = $width;
				$new_h = ceil($h * $rasio);
			}
			else  // tinggi
			{
				$rasio = $height / $h;
				$new_w = ceil($w * $rasio);
				$new_h = $height;
			}
		} else {
			$new_w = $w;
			$new_h = $h;
		}
		
		$img_tmp = imagecreatetruecolor($new_w, $new_h);
		imagecopyresampled($img_tmp, $source, 0,0,0,0, $new_w, $new_h, $w, $h);
		$name_output = $pne['path'].'/'.$pne['name'].'_'.$new_w.'x'.$new_h.'.jpg';
		imagejpeg($img_tmp, $name_output); 
		return $name_output;
	}
	
	
	function resize2jpg($filename, $width = 250, $height = 170, $width_cut=500, $heigh_cut=400)
	{
		// get ukuran image (lebar & tinggi)
		list($w, $h) = getimagesize($filename);
		
		// dapatkan nama, path, ext
		$pne = $this->pathnameext($filename);
		
		// source by ext
		switch($pne['ext']){
			case 'gif':
				$source = imagecreatefromgif($filename);
			break;
			case 'png':
				$source = imagecreatefrompng($filename);
			break;
			default:
				$source = imagecreatefromjpeg($filename);
			break;		
		}
		
		// cut image 700h x 500w => 400h x 500w
		$img_tmp_cut = imagecreatetruecolor($width_cut, $heigh_cut);
		imagecopyresampled($img_tmp_cut, $source, 0,0,0,0, $width_cut, $heigh_cut, $width_cut, $heigh_cut);
		
		// rasio ukuran
		if($width_cut > $heigh_cut) // lebar
		{
			$rasio = $width / $width_cut;
			$new_w = $width;
			$new_h = ceil($heigh_cut * $rasio);
		}
		else  // tinggi
		{
			$rasio = $height / $heigh_cut;
			$new_w = ceil($width_cut * $rasio);
			$new_h = $height;
		}
		
		// create new image
		$img_tmp = imagecreatetruecolor($new_w, $new_h);
		imagecopyresampled($img_tmp, $img_tmp_cut, 0,0,0,0, $new_w, $new_h, $width_cut, $heigh_cut);
		$name_output = $pne['path'].'/'.$pne['name'].'_'.$new_w.'x'.$new_h.'.jpg';
		imagejpeg($img_tmp, $name_output); 
		return $name_output;
	}

	function thumb($path_img, $width = 250, $height = 250){
			
		$ary = $this->pathnameext($path_img);

		$thumb 	= $ary['path'] . '/' . $ary['name'] . $this->cfg['thumb_marker'] .'.'. $ary['ext'];
		
		$url	= $ary['url'] . '/' . $ary['name'] . $this->cfg['thumb_marker'] .'.'. $ary['ext'];
		
		if(file_exists($thumb)) return $url;
		
		else {
			
			$this->cfg['source_image'] 	= $ary['path'] . '/' . $ary['name'] .'.'. $ary['ext'];
			
			$this->ci->image_lib->initialize($this->cfg);
			
			if($this->ci->image_lib->resize()) return $url;
				
			else return $this->ci->image_lib->display_errors();
		}
		
	}


}
