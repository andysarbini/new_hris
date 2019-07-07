<?php
$html = '<option value="0" >&nbsp;</option>';//'.($selected==0 ? 'selected': '').'
foreach($options as $d){
	$html .= '<option value="'.$d->id.'" '.($selected == $d->id ? 'selected="selected"': '').'>'.$d->name.'</option>';
}
echo $html;