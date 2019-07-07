<nav class="navbar">
	<div class="navbar-header">
		<a href="<?php echo base_url();?>" class="navbar-brand logo">
		<div class="logo"><img src="<?php echo template_img(); ?>/logo-alt.png" class="img-responsive"></div>
		<span class="sr-only">Bluebird</span>
		</a>
	</div>
	<!-- Accordion menu navigation -->
	<div id="accordion">
		<ul class="panel" onclick="openNav()">
		<?php 
		foreach($menus as $var=>$v){ 
			$_fa    = array("fa-bolt", "fa-file", "fa-image", "fa-car", "fa-opencart", "fa-question-circle");
		
			?>
			<li class="panel-header btn">
				<div class="icon-left"><span class="fa <?php echo $_fa[$var];?> fa-fw fa-lg"></span></div>
				<!-- Parent -->
				<a href="<?php echo gen_url_by_type_nav($v, $v["type_id"]);?>">
					<?php echo $v["title"];?>
				</a>
				<?php if(isset($v["childs"]) && count($v["childs"]) > 0){ ?>
					<div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-'<?php echo $v["title"];?>'" aria-expanded="false" aria-controls="bs-collapse-'<?php echo $v["title"];?>'">
						<span class="fa fa-caret-down"></span>
					</div>
					<div id="bs-collapse-'<?php echo $v["title"];?>'" class="collapse" aria-labelledby="bs-collapse-'<?php echo $v["title"];?>'" data-parent="#accordion">
						<!-- 2nd child -->
						<ul>
						<?php foreach($v["childs"] as $cvar=>$c){ ?>
							<li><a href="<?php echo gen_url_by_type_nav($c, $c["type_id"]);?>"><?php echo $c["title"];?></a></li>
						<?php } ?>
						</ul>
					</div>
				<?php 
					}
			?>
			</li>

		<?php 
		
	
		} 
		?>
		</ul>
	</div>
</nav>

<!--

// Parent

<li class="panel-header btn">
	<div class="icon-left">
		<span class="fa fa-car fa-fw fa-lg"></span>
	</div>
	
	<a href="pages/pusat-informasi.html">Pusat Informasi</a>
	<div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-pusat-informasi" aria-expanded="false" aria-controls="bs-collapse-pusat-informasi">
		<span class="fa fa-caret-down"></span>
	</div>

	// 2nd child

	<div id="bs-collapse-pusat-informasi" class="collapse" aria-labelledby="bs-collapse-pusat-informasi" data-parent="#accordion">
		<ul>
			<li>
				<div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-panduan-prosedur" aria-expanded="false" aria-controls="bs-collapse-panduan-prosedur">
					<span class="fa fa-caret-down"></span>
				</div>
				<a href="pages/panduan-prosedur.html">Panduan & Prosedur</a>

				// 3rd child

				<div id="bs-collapse-panduan-prosedur" class="collapse" aria-labelledby="bs-collapse-panduan-prosedur" data-parent="#accordion">
					<ul>
						<li><a href="pages/rekrutmen.html">Rekrutmen</a></li>
						<li><a href="pages/rekrutmen.html">Karyawan Baru</a></li>
						<li><a href="pages/masa-percobaan.html">Masa Percobaan</a></li>
						<li><a href="pages/manajemen-kinerja.html">Manajemen Kinerja</a></li>
						<li><a href="pages/rating-calibration.html">Rating Calibration</a></li>
						<li><a href="pages/talent-mapping.html">Talent Mapping</a></li>
						<li><a href="pages/medical.html">Medical</a></li>
						<li><a href="pages/bpjs-ketenagakerjaan.html">BPJS Ketenagakerjaan</a></li>
						<li><a href="pages/aturan-kehadiran-ketidakhadiran.html">Aturan Kehadiran & Ketidakhadiran</a></li>
						<li><a href="pages/prosedur-pengunduran-diri.html">Prosedur Pengunduran Diri</a></li>
					</ul>
				</div>
			</li>
			<li>
				<a href="pages/formulir.html">Formulir</a>
			</li>
			<li>
				<div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-panduan-learning" aria-expanded="false" aria-controls="bs-collapse-panduan-learning">
					<span class="fa fa-caret-down"></span>
				</div>
				<a href="pages/learning.html">Learning</a>
				
				// 3rd child
				
				<div id="bs-collapse-panduan-learning" class="collapse" aria-labelledby="bs-collapse-panduan-learning" data-parent="#accordion">
					<ul>

						<li><a href="pages/formulir.html">Knowledge Management</a></li>
						<li><a href="pages/pengumuman-learning-events.html">Pengumuman Learning & Events</a></li>
					</ul>
				</div>
			</li>
			<li>
				<div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-hr" aria-expanded="false" aria-controls="bs-collapse-hr">
					<span class="fa fa-caret-down"></span>
				</div>
				<a href="pages/hr.html">HR</a>
				<div id="bs-collapse-hr" class="collapse" aria-labelledby="bs-collapse-hr" data-parent="#accordion">
					<ul>
						<li><a href="pages/kehadiran.html">Kehadiran</a></li>
						<li><a href="pages/cuti.html">Cuti</a></li>
						<li><a href="pages/ijin.html">Ijin</a></li>
						<li><a href="pages/sakit.html">Sakit</a></li>
						<li><a href="pages/ketentuan-tunjangan.html">Ketentuan Tunjangan</a></li>
						<li><a href="pages/pengajuan-cuti.html">Pengajuan Cuti</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</li>

-->
