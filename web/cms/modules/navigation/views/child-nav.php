<?php 
if(count($menus)){ ?>
<ul class="nav nav-tabs nav-stacked bgtransitions accordion">
<?php 
//echo 'count:'.count($menus);
$before_uri = '';
$before_title = '';
$before_level = 0;
#$c = -1; // version 1
$c=0;

$before_write	= '';

$out = '';

#$menus[] = array('uri'=>'', 'level'=>0, 'title'=>'');

$last = count($menus);

$end_child = array();



foreach($menus as $menu=>$m){  
	
	if($end_child){
		
		if( $m['level'] > $before_level) // yang end child, punya child 
			$out .= '<li><a href="'.@if_empty($before_uri, '#').'" onclick="return false" class="accordion-toggle" data-toggle="collapse" data-target="#'.$before_uri.'">'.$before_title.'</a>';
			$out .= '<ul id="'.$before_uri.'" class="accordion-body collapse in">'."\r";
			
			$m['level'] = $before_level;
	}
	
	if(++$c){
		if($m['level'] === $before_level) // menu sebelum nya tidak punya anak #2
			$out .= "<li><a href='".$m['uri']."'>".$m['title']."</a></li>\r"; 
	
		if($m['level'] > $before_level) {// menu ini adalah (start) child dari menu sebelumnya #3
			$out .= '<li><a href="'.@if_empty($m['uri'], '#').'" onclick="return false" class="accordion-toggle" data-toggle="collapse" data-target="#'.$m['uri'].'">'.$m['title'].'</a>';
			$out .= '<ul id="'.$m['uri'].'" class="accordion-body collapse in">'."\r";
		}
		if($m['level'] < $before_level){ // menu sebelum nya, (stop) child
			$out .= "\r</ul>\r</li>\r";
			$end_child = true;
		}
		
	}
	
	$before_uri = $m['uri'];
	$before_level = $m['level'];
	$before_title = $m['title'];

}

echo $out;

/* version 1
if($c++){
	if($m['level'] === $before_level) // menu sebelum nya tidak punya anak 
		$out .= "<li><a href='".$m['uri']."'>".$m['title']."</a></li>\r";
	
	if($m['level'] > $before_level) {// menu ini adalah (start) child dari menu sebelumnya
		$out .= '<li><a href="'.if_empty($m['uri'], '#').'" onclick="return false" class="accordion-toggle" data-toggle="collapse" data-target="#'.$m['uri'].'">'.$m['title'].'</a>';
		$out .= '<ul id="'.$m['uri'].'" class="accordion-body collapse in">'."\r";	
	}
	if($m['level'] < $before_level){ // menu sebelum nya, (stop) child
		#$out .= '<li><a href="'.$m['uri'].'">'.$m['title']."</a></li>\r</ul>\r</li>\r";
		#$out .= "\r</ul>\r</li>\r";
		$out .= "\r</ul>\r</li>\r<li><a href='".$m['uri']."'>".$m['title']."</a></li>";
	}
}	
	$before_uri = $m['uri'];
	$before_level = $m['level'];
	$before_title = $m['title'];
/**/
#echo "<li><a href='{$m['uri']}'>{$m['title']} {$m['level']}</a></li>\r\n";

?></ul><?php } ?>
