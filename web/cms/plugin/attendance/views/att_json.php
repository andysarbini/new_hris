<?php
    
    $_tmp = array();
    
    foreach($att as $_var=>$_) $_tmp[$_->date_in] = array('id'=>$_->att_id,'time_in'=>$_->time_in, 'time_out'=>$_->time_out); 
    
    echo json_encode($_tmp);
?>