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
	
	if(!preg_match('~http\:\/\/~', $path)) 	$path = base_url().$path;
	
	$ci->image->config(array('width'=>$width,'height'=>$height));
	
	$thumb	= $ci->image->thumb($path);
	
	unset($ci); // just optimization
	
	return $thumb;	
}

function img_resize($path, $width=250, $height=250){
	
	$ci 	= @get_instance();
	
	$ci->load->library('Image','image');
	
	if(!preg_match('~http\:\/\/~', $path)) 	$path = base_url().$path;
	
	$ci->image->config(array('width'=>$width,'height'=>$height));
	
	$thumb	= $ci->image->resize($path);
	
	unset($ci); // just optimization
	
	return $thumb;	
}

function img_profile($path, $width=250, $height=250){
	
	$ci 	= @get_instance();
	
	$ci->load->library('Image','image');
	
	if(!preg_match('~http\:\/\/~', $path)) 	$path = base_url().$path;
	
	$ci->image->config(array('width'=>$width,'height'=>$height));
	
	$thumb	= $ci->image->resize($path);
	
	unset($ci); // just optimization
	
	return $thumb;	
}

function get_image_gallery_path($gall_id){
	$image_path = "";
	$ci 	= @get_instance();
	$ci->load->model('dashboard_m');
	$filter['GALL_ID'] = $gall_id;
	$result = $ci->dashboard_m->get_pics_info($filter);
	if($result){
		if(@if_empty($result->GALL_PIC_THUMBNAIL)){
			$image_path = base_url()."uploads/galleries/".$result->GALL_PIC_THUMBNAIL;
		}else{
			$image_path = base_url()."uploads/galleries/".$result->GALL_PIC_PATH;
		}
	}
	return $image_path;
}

