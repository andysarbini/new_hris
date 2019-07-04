<?php 
$html = '';
$_base = base_url();
$url = '';
if(isset($breadcrumb)){
foreach($breadcrumb as $uri=>$title) {
	$url .= '/'.$uri;
	$html .= " &raquo; <a href='".$_base.'pages'.$url."'>{$title}</a>";
}
}
echo $html;
?>
