<?php 

$c 			= 0;
$li			= '';
$carousel	= '';
$dir		= base_url().Modules::run('api/options', 'mdl_gallery_upload_path');

foreach( $mdl as $m){
	
	$pic = Modules::run('property/get_single_img', $m->galery);
	
	$l = img_thumb($dir.'/'.$pic,900,500);
	
	$li .= '<li data-target="#slideshow" data-slide-to="'.$c.'" '.($c?'':'class="active"').'></li>';
	
	$carousel .= '
<div class="item '.($c++?'':'active').'">
	<img src="'.$l.'" alt="" class="img-responsive" style="margin-top:-100px;"/>
	<div class="carousel-caption" style="margin-top:100px;">
			
		<h4 class="orange">Rp. '.number_format($m->price ,0,',','.').'</h4>
		<h5>'.$m->title.'</h5>
		<p>'.$m->bedrooms.' Bedrooms, '.$m->bathrooms.' Bathrooms, Build '.$m->year.', </p>
		<p><a class="btn btn-primary  btn-sm" href="'.base_url().'property/detail/'.$m->id.'_'.$m->uri.'#sidebar-left">Learn more</a></p>
	</div>
</div>';

}

if($pro){
	
	
	
	foreach($pro as $m){
		
		$l = img_thumb($dir.'/'.$m->pic,900,500);
		
		$li .= '<li data-target="#slideshow" data-slide-to="'.$c.'" '.($c?'':'class="active"').'></li>';
		
		$carousel .= '
<div class="item '.($c++?'':'active').'">
	<img src="'.$l.'" alt="" class="img-responsive" style="margin-top:-100px;"/>
	<div class="carousel-caption" style="margin-top:100px;">
		
		<h4 class="orange">'.$m->title.'</h4>
		<h5></h5>
		<p> </p>
		<!--p><a class="btn btn-primary  btn-sm" href="'.base_url().'property/detail/'.$m->id.'_'.$m->uri.'#sidebar-left">Learn more</a></p-->
	</div>
</div>';
	}
}

//dump($m);
?>
<div id="slideshow" class="carousel slide"> <!-- Slideshow -->
	<ol class="carousel-indicators">
		<?php echo $li;?>
	</ol> <!-- /indicators -->

	<div class="carousel-inner">   <!-- Wrapper for slides -->
		<?php echo $carousel;?>	
	</div>
	<a class="left carousel-control" href="#cslideshow" data-slide="prev">  <!-- controls -->
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control" href="#slideshow" data-slide="next">
		<span class="icon-next"></span>
	</a>
</div>