<?php
$nav = '';

$slides = '';

$c = 0;

$length = count($mdl);

$url = base_url().'content/';

foreach( $mdl as $m){

	if($c % 4 == 0) $slides .=  '<div class="row" id="product_center">'."\r\n";
	
	$slides .= '<div class="col-md-3">'."\r\n";
	
	
	$slides .= if_empty($m->pic_name) ? '<div class="text-left panel" style="display:none;"><a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><h4>'.$m->pic_name.'</h4></a>'."\r\n":'';
	
	$slides .= if_empty($m->pic_ket) ? '<p>'.$m->pic_ket.'</p>'."\r\n" : '';
	
	//@$slides .= if_empty($m->post_id) ? '<a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><p>See detail</p></a>':'';
	
	$slides .= if_empty($m->pic_name) ? '</div>'."\r\n":'';
	
	
	$slides .= '<a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'"/></a>'."\r\n";
	
	
	$slides .= '</div>'."\r\n";
	
	$c++;
	
	if($c % 4 == 0) $slides .=  '</div>'."\r\n";
	
	//dump($m);
	
}

/*just for tsa
session_start();
$_SESSION['gallery_type']="product";

echo $slides;*/

/*--slide 4 item--*/
/*foreach( $mdl as $m){

	if($c % 4 == 0) $slides .=  '<div class="item '.( $length == $c ? 'active':'').'">'."\r\n";
	if($c % 4 == 0) $slides .=  '<div class="row">'."\r\n";
	
	
	$slides .= if_empty($m->pic_name) ? '<div class="col-sm-2 project_thumbnail"><a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'" class="thumbnail"><h4>'.$m->pic_name.'</h4><img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'"/><p>'.$m->pic_ket.'</p></a>'."\r\n":'';
	
	//$slides .= if_empty($m->pic_ket) ? '<p>'.$m->pic_ket.'</p>'."\r\n" : '';
	
	//@$slides .= if_empty($m->post_id) ? '<a href="'.$url.$m->post_id.'/'.to_uri($m->pic_name).'"><p>See detail</p></a>':'';
	
	//$slides .= '<img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'"/>'."\r\n";
	
	$slides .= if_empty($m->pic_name) ? '</div>'."\r\n":'';	
	
	$c++;
	
	if($c % 4 == 0) $slides .=  '</div>'."\r\n";
	if($c % 4 == 0) $slides .=  '</div>'."\r\n";
	
	//dump($m);
	
}*/

?>

<div class="container">
<div class="col-md-12">
	<?php echo $slides; ?>
</div>
</div>

