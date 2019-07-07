<?php 
/** Helper to get options value */
function get_option_value($opt_name,$opt_value){
	$value = "";
    $ci 	= @get_instance();
    
	$ci->load->model('options/opt_m');
	$filter['OPT'] = $opt_name;
    $result = $ci->opt_m->find_option_val($filter);
	if($result->OPT_VAL){
        $options = json_decode($result->OPT_VAL, true);
        foreach($options as $k => $v){
            if($k == $opt_value){
                $value = $v;
            }
        }
	}
	return $value;
}