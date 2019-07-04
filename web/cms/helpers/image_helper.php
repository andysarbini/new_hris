<?php 
/**
 * menerima path asli
 * memberikan path thumbnail
 * digunakan untuk komputasi kecil
 * 
 * untuk komputasi besar gunakan library image
 * agar menghindari pembuatan instance berulang (isu performance)
 * 
 * @param unknown $path
 * @param unknown $width
 * @param unknown $height
 * @return unknown
 */
function img_thumb($path, $width=250, $height=250){
	
	$ci 	= @get_instance();
	
	$ci->load->library('Image','image');
	
	if(!preg_match('~http\:\/\/~', $path)) 
		
		$path = base_url().$path;
	
	$ci->image->config(array('width'=>$width,'height'=>$height));
	
	$thumb	= $ci->image->resize($path);
	
	unset($ci); // just optimization
	
	return $thumb;	
}
