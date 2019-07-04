<div class="col-md-10 col-md-push-1 dashboard-panels">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Total Rekam
					<br />
					<span id='tgl_tunggal'></span>
				</div>
				<div class="chart-stage row">
						<div class='col-md-6 warna-dc text-center'>
							<span>DC</span>
							<h1 id='jumlah_rekam_dc'></h1>
					</div>
					<div class='col-md-6 warna-drc text-center'>
						<span>DRC</span>
						<h1 id='jumlah_rekam_drc'></h1>
					</div>
				</div>
				<div class="chart-notes">
					<a href="<?php echo base_url()."dashboard/penunggalan";?>">
						Dashboard Perekaman <span class="glyphicon glyphicon-link"></span>
					</a>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Total Cetak
					<br />
					<span id='tgl_cetak'></span>
				</div>
				<div class="chart-stage row">
						<div class='col-md-6 warna-dc text-center'>
							<span>DC</span>
							<h1 id='jumlah_cetak_dc'></h1>
					</div>
					<div class='col-md-6 warna-drc text-center'>
						<span>DRC</span>
						<h1 id='jumlah_cetak_drc'></h1>
					</div>
				</div>
				<div class="chart-notes">
					<a href="<?php echo base_url()."dashboard/pencetakan";?>">
						Dashboard Pencetakan <span class="glyphicon glyphicon-link"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
