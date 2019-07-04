<?php 

$c 			= 0;
$large_img	= '';
$thumb_img	= '';
$dir		= base_url().Modules::run('api/options', 'mdl_gallery_upload_path');

foreach( $mdl as $m){

	$l = img_thumb($dir.'/'.$m->pic_path,960,800);
	
	$t = img_thumb($dir.'/'.$m->pic_path,100,100);
	
	$large_img .= '<div class="item '.($c ? '':'active').'"><img src="'.$l.'" alt="'.$m->pic_name.'" class="img-responsive" style="margin-top:-80px;"/></div>';
	
	$thumb_img .= '<li data-target="#gallery" data-slide-to="'.$c.'" '.($c ? '':'class="active"').'><img src="'.$dir.'/blank.png" data-original="'.$t.'" class="img-responsive img-thumbnail lazy" /></li>';
	
	$c++;
}

?>
<div id="gallery" class="carousel slide">
	<div class="carousel-inner">
		<!-- Wrapper for slides -->
		<?php echo $large_img;?>
	</div>
	<ol class="carousel-indicators col-lg-6 col-md-6 col-xs-12 text-left">
		<?php echo $thumb_img;?>
	</ol>
	<!-- /indicators -->
</div>
