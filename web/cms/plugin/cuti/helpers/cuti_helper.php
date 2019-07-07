<?php  defined('BASEPATH') OR exit('No direct script access allowed');

// http://php.net/manual/en/function.date-diff.php
function duration($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return (int) $interval->format($differenceFormat) + 1;
   
}


function get_user($_param){
	
	$ci =& get_instance();
	
	$ci->load->model('bluehrd/bluehrd_user_m');
	
	return $ci->bluehrd_user_m->get_user($_param);
}

function status($_id){
	
	$_a = array("Tolak","Pending","Setujui");
	
	return $_a[$_id];
}

// if dd-mm-yyyy to yyyy-mm-dd
// if yyyy-mm-dd to dd-mm-yyyy 
function bbdate($_tgl){
	
	$_ = explode('-', $_tgl);
	
	return $_[2].'-'.$_[1].'-'.$_[0];
}

// return number
function sisa_cuti($thn, $usr_id){
	
	$ci =& get_instance();
	
	$ci->load->model('cuti_m');
	
	$total_cuti = $ci->cuti_m->total_quota_cuti();
	
	$sudah_cuti	= $ci->cuti_m->sudah_cuti($thn, $usr_id);
	
	return $total_cuti - $sudah_cuti;
	
}
