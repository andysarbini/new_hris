<?php
$html = '<option value="0" '.($selected==0 ? 'selected': '').'>&nbsp;</option>';
foreach($options as $d){
	$html .= '<option value="'.$d->id.'" '.($selected==$d->id ? 'selected="selected"': '').'>'.$d->title.'</option>';
}
echo $html;