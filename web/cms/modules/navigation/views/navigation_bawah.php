<?php
/**
 * file ini di edit untuk pembentukan navigasi html
 */

if ($jml = count($menus)) {
$c = 1;
foreach ($menus as $menu=>$t) {
	if($c == 1) $class = 'first';
	elseif($c == $jml) $class = 'last';
	else $class= '';
	
	echo "<li class='".$class."'><a href='".base_url()./*current_class()*/'pages'.'/'.$t['uri']."'>".$t['title']."</a></li>\r";
	$c++;
	}
}
