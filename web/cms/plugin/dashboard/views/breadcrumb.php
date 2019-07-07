<?php
$_base = base_url();
$html = '<ol class="breadcrumb">';
$html .= '<li><a href="'.$_base.'">Dashboard</a></li>';
if(@if_empty($breadcrumb_parent) && @if_empty($breadcrumb_parent_uri)){
    $html .= '<li><a href="'.$_base.$breadcrumb_parent_uri.'">'.$breadcrumb_parent.'</a></li>';
}
if(@if_empty($breadcrumb_parent_cat) && @if_empty($breadcrumb_parent_cat_uri)){
    $html .= '<li><a href="'.$_base.$breadcrumb_parent_uri."/".$breadcrumb_parent_cat_uri.'">'.$breadcrumb_parent_cat.'</a></li>';
}
$html .= "<li class='active'>".$breadcrumb_active."</li>";
$html .= '</ol>';

echo $html;
?>