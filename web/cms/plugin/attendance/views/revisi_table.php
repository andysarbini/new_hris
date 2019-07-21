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
								
								if($_slc_year !== '') echo $_slc_year;

								else {
									$_now_year = date('Y');
									echo "<option value='".$_now_year."' selected>".$_now_year."</option>";
								}
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
					<a href="<?php echo base_url()."attendance/revisi/form";?>" class="btn btn-white">
						<i class="fa fa-plus"></i> Revisi 
					</a>
					<a href="<?php echo base_url()."attendance";?>" class="btn btn-white">
						<i class="fa fa-list"></i> Absensi 
					</a>
				</form>
			</div>
			<div class='ibox-content'>
<?php
	if(count((array) $revs)){

		$_a_jenis = json_decode(mdl_opt('bb_opt_tipe_revisi'), true);
		$_a_status= array("Open", "Close");
		$_a_keputusan = array("Tolak", "Terima");

		echo "<table class='table table'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Mulai</th>";
		echo "<th>Selesai</th>";
		echo "<th>Pengajuan</th>";
		echo "<th>Status</th>";
		echo "<th>Keputusan</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($revs as $var=>$_){
			echo "<tr>";
			echo "<td>".$_->date_from."</td>";
			echo "<td>".$_->date_to."</td>";
			echo "<td>".$_a_jenis[$_->rev_type_id]."</td>";
			echo "<td>"."<a href='".base_url()."attendance/revisi/form/".$_->rev_id."'>".$_a_status[$_->closed_status]."</a></td>";
			echo "<td>".($_->closed_date? $_a_keputusan[$_->closed_status]:"Waiting")."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		
	} else {
		echo "<center>Tidak Ada pengajuan revisi</center>";
	}
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
