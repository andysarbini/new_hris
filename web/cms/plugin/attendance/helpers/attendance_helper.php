<?php
	function att_to_array($data){
		
		$_ = array();
		/* format
		[
			'2018-03-05' => [
			  'text' => "An event for the 5 july 2015",
			  'href' => "http://example.com/link/to/event"
			],
			...
		]
		*/
		foreach($data as $var=>$val){

			$tgl_in = $val->date_in;

			$_[$tgl_in] = array("text"=>'<span class="label label-'.$val->status.'">'.$val->status.'</span><div class="sr-only">' . substr($val->time_in,0,-3)." <span class='fas fa-arrow-right fa-fw' aria-hidden='true'></span> ".substr($val->time_out,0,-3) . '</div>', "href"=>"");
		}

		return $_;
	}
	
	
	function att_csv2mysql_date($tgl = "5/1/2018"){
		
		$_ = explode("/", $tgl);
		
		return $_[2].'-'.$_[0].'-'.$_[1];
	}
	
	
	// add second, convert 05:55 to 05:55:00
	function time_attendance($_t){
		
		$_s = count(explode(":",$_t)) == 3 ? "":":00";
		
		return $_t.$_s;
	}
	// return current time to
	function get_now_time(){
		
		return explode(' ', date('Y-m-d H:i:s'));
	}
	/*
	_var = variable yg di berikan user
	_off = lang / lot office 
	_r = kisaran nilai yang di bolehkan

	_off = 6.832901
	_var = 6.832900
	_r = 0.000001
	accept if _var >= _off - _r && _var <= _off + _r
	*/
	function accept_lat_lon($_var, $_off, $_r = 0){

		$_down 	= (float)$_off - (float)$_r;

		$_up	= (float)$_off + (float)$_r;

		if($_var >= $_down && $_var <= $_up) return true;

		else return false;
	}