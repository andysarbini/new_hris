<?php

$nav = '';
$slides = '';

$c = 0;

$length = count($mdl);

foreach( $mdl as $m){
	
	$nav .= '<li data-target="#myCarousel" data-slide-to="'.$c++.'" class="'.( $length == $c ? 'active':'').'"></li>';
	
	$slides .= '<div class="item '.( $length == $c ? 'active':'').'">
		<div style="position:relative;animation:animation-top 3s;-webkit-animation:animation-top 3s"><img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'" /></div>
		<div class="carousel-caption">
		<h1 style="position:relative;animation:text-animation-top 1s;-webkit-animation:text-animation-top 1s">'.$m->pic_name.'</h1>
		<h2 style="position:relative;animation:text-animation-left 1s;-webkit-animation:text-animation-left 1s">'.$m->pic_ket;
		
	@$slides .= if_empty($m->post_id) ? '<a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><p>detail</p></a>':'';
	
	$slides .= '</h2>
		</div>
	</div>';
	
}
?>
<div id="slides">
	<div id="myCarousel" class="carousel slide">
		<ol class="carousel-indicators">
			<?php echo $nav; ?>
		</ol>
	<div class="carousel-inner">
		<?php echo $slides; ?>	
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
	</div>
</div>

