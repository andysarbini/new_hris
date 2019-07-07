<?php

	$time_in = @if_empty($att->time_in, date("Y-m-d H:i:s"));

	$_ti = explode(" ", $time_in);
	$__i = explode("-", $_ti[0]);
	$__j = explode(":", $_ti[1]);

	$time_out= @if_empty($att->time_out, date("Y-m-d H:i:s"));

	$_to = explode(" ", $time_out);
	$__o = explode("-", $_to[0]);
	$__p = explode(":", $_to[1]);

	$_a = array(
			"att_id"	=> @if_empty($att->att_id, 0),
			"year_in"	=> $__i[0],
			"month_in"	=> $__i[1],
			"date_in"	=> $__i[2],
			"hour_in"	=> $__j[0],
			"minute_in"	=> $__j[1],
			
			"year_out"	=> $__o[0],
			"month_out"	=> $__o[1],
			"date_out"	=> $__o[2],
			"hour_out"	=> $__p[0],
			"minute_out"=> $__p[1],
		);
	
	header('Content-type: application/json');
	
	echo json_encode($_a);
?>
