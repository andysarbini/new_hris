<?php

$nav = '';
$slides = '';

$c = 0;

$length = count($mdl);

foreach( $mdl as $m){
	//dump($m);
	$slides .= '<div class="'. $m->pic_ket. ' col-md-4 '.( $length == $c ? 'active':'').'">
		<div>
			<div class="isotope-img">
				<img src="'.$pic_path.'/'.$m->pic_path.'" alt="'.$m->pic_name.'" />
			</div>
			<h4>'.$m->pic_name.'</h4>
		</div>
		</div>';
	
}
?>

<?php echo $slides; ?>


