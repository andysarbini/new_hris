<div class="form-inline filter-on-top">
	<form method="get">
		<label class="control-label">Pilih tahun</label>
		<div class="form-group">
			<select name="year" class="form-control">
		<?php
			$_slc_year = "";
			for($i = $min_year; $i <= $max_year; $i++) $_slc_year .=  "<option value='".$i."'".($year == $i ? " selected":"").">".$i."</option>";
			echo $_slc_year;
		?>
			</select>
		</div>
		<label class="control-label">Pilih bulan</label>
		<div class="form-group">
			<select name="month" class="form-control">
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
		</div>
		<input type="submit" class="btn btn-default" value="Tampilkan">
	</form>
</div>

<?php
	$this->load->helper("calender");
	echo build_html_calendar($year, $month, $att);
?>

<!-- Letakkan di sini -->


<ul class="list-inline legend">
	<li><span class="label label-H">H</span> Hadir</li>
	<li><span class="label label-C">C</span> Cuti</li>
	<li><span class="label label-S">S</span> Sakit</li>
	<li><span class="label label-I">I</span> Izin</li>
	<li><span class="label label-A">A</span> Absen</li>
	<li><span class="label label-TLT">TLT</span> Telat</li>
	<li><span class="label label-PC">PC</span> Pulang Cepat</li>
</ul>
