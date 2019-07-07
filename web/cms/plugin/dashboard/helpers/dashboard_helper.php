<?php
function bluehrd_tgl($_tgl){
    $_  = explode(" ",$_tgl);
    $t  = explode("-",$_[0]);
    $_bln = array(
            "01"=>"January","02"=>"February", "03"=>"Maret","04"=>"April",
            "05"=>"Mei", "06"=>"Juni", "07"=>"July", "08"=>"Agustus",
            "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"
        );
    return $t[2]." ".$_bln[$t[1]]." ".$t[0];
}

function check_is_already_rated($post_id, $user_id, $label, $type){
    $ci 	= @get_instance();
    $ci->load->model('dashboard_m');
    $result = $ci->dashboard_m->check_is_already_rated($post_id, $user_id, $label, $type);
    return $result;
}
