<form method="get">
	<select name="year">
<?php
	$_slc_year = "";
	for($i = $min_year; $i <= $max_year; $i++) $_slc_year .=  "<option value='".$i."'".($year == $i ? " selected":"").">".$i."</option>";
	echo $_slc_year;
?>
	</select>
	<select name="month">
<?php 
	$months = array(
		"1"=>"Januari", "2"=>"Februari", "3"=>"Maret", "4"=>"April",
		"5"=>"Mei", "6"=>"Juni", "7"=>"Juli", "8"=>"Augustus", 
		"9"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"                    
	);
	$_slc_month = "";
	foreach($months as $var=>$val) $_slc_month .=  "<option value='".$var."'".($month == $var ? " selected":"").">".$val."</option>";
	echo $_slc_month;
?>
	</select>
	<input type="submit" class="btn btn-info" value="Show">
</form>

