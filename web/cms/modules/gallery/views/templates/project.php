<?php

$nav = '';
$slides = '';

$c = 0;

$length = count($mdl);

foreach( $mdl as $m){
	
	
	
	$slides .= '
	<div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$c.'">
			<img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'"/>
		  </a>
		</div>
		<div id="collapse'.$c.'" class="accordion-body collapse '.($c==0? 'in':'').'">
		  <div class="accordion-inner">
			<strong>'.$m->pic_name.'</strong> '.$m->pic_ket;
			
	@$slides .= if_empty($m->post_id) ? '<a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><p>detail</p></a>':'';
	
	$slides	.='  </div>
		</div>
	</div>';
	
	$c++;
}
?>

<div class='content-center'>
	<div class="accordion" id="accordion2">
	<?php echo $slides;?>
	</div>
</div>
