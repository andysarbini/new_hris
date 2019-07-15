<div class='row'>
	<div class='col-md-6'>
		<div class="ibox">
			<div class='ibox-title'>
				<form class='form-inline' role='form' method="get">
					<div class="form-group">
						<select name="year" class="form-control">
							<?php
								$_slc_year = "";
								for($i = $min_year; $i <= $max_year; $i++) $_slc_year .=  "<option value='".$i."'".($year == $i ? " selected":"").">".$i."</option>";
								echo $_slc_year;
							?>
						</select>
					</div>
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
					<button class="btn btn-white" type="submit">Tampilkan</button>
					<a href="<?php echo base_url()."attendance/att";?>" class="btn btn-white">
						<i class="fa fa-plus"></i> Absensi Masuk 
					</a>
				</form>
			</div>
			<div class='ibox-content'>
				<?php $this->load->helper("calender");
					echo build_html_calendar_vertical($year, $month, $att);
				?>
			</div>
		</div>
	</div>
</div>

<!--div class='col-md-6'>
	<div class='ibox'>
		<div class='ibox-content'>
			<span class="label label-H">H</span> Hadir
			<span class="label label-C">C</span> Cuti
			<span class="label label-S">S</span> Sakit
			<span class="label label-I">I</span> Izin
			<span class="label label-A">A</span> Absen
			<span class="label label-TLT">TLT</span> Telat
			<span class="label label-PC">PC</span> Pulang Cepat
		</div>
	</div>
</div-->
