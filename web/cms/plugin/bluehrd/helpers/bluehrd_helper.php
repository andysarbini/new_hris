<?php
/**
 * $data = array()
 */
function cfg_to_slc($data, $selected = null){
	
	// khusus case bluebird
	$_tmp_slc = array();

	foreach($data as $var=>$val) $_tmp_slc[] = array("id"=>$val, "title"=>$val);
	
	return gen_option_html($_tmp_slc, $selected); 
}