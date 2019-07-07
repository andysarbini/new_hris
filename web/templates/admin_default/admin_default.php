<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo if_empty($title,'Hello'); ?> - Administration</title>

	<link rel="stylesheet" href="<?php echo admin_css(); ?>/jquery-ui-1.10.3.min.css">
	<link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/template.css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--<?php echo inc_script(array('js/jquery-1.9.1.min.js')); ?>-->
	<script src="<?php echo template_js(); ?>/assets/jquery-3.1.0.min.js"></script>
	<script src="<?php echo admin_js(); ?>/assets/bootstrap.min.js"></script>
	<?php echo @if_empty($include_script,''); ?>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
</head>
<script type="text/javascript"> function base_url(){ return "<?php echo base_url();?>" } </script>
<body class="admin">
	<nav class="navbar navbar-inverse navbar-fixed-top top-nav scms-doc-nav" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="<?php echo base_url();?>admin" class="navbar-brand logo">
					<div class="logo"><img src="<?php echo template_img();?>/logo-alt.png" class="img-responsive"></div>
				</a>
			</div>
			<ul class="nav navbar-nav hidden-xs hidden-sm">
				<li><a href="<?php echo base_url();?>admin">Panel Kendali</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span>Sistem</span>
						<span class="fas fa-caret-down fa-fw" aria-hidden="true"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Navigasi</li>
						<li><a href="<?php echo base_url();?>admin/navigation">Menu</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Pengguna</li>
						<li><a href="<?php echo base_url();?>admin/group">Kelompok</a></li>
						<li><a href="<?php echo base_url();?>admin/user">Pengguna</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span>Konten</span>
						<span class="fas fa-caret-down fa-fw" aria-hidden="true"></span>
					</a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/category">Kategori</a></li>
						<li><a href="<?php echo base_url();?>admin/content">Konten</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span>Modul</span>
						<span class="fas fa-caret-down fa-fw" aria-hidden="true"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Cuti</li>
						<li><a href="<?php echo base_url();?>admin/cuti">Izin Cuti</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Forum</li>
						<li><a href="<?php echo base_url();?>admin/forum">Kategori</a></li>
						<li><a href="<?php echo base_url();?>admin/forum/detail/1">Konten</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Galeri</li>
						<li><a href="<?php echo base_url();?>galleri/admin">Foto & Video</a></li>
						<li><a href="<?php echo base_url();?>galleri/admin/detail/17">Slideshow Halaman Utama</a></li>
						<li><a href="<?php echo base_url();?>admin/content">Slideshow News</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Karyawan</li>
						<li><a href="<?php echo base_url();?>admin/qa">Ajukan Pertanyaan</a></li>
						<li><a href="<?php echo base_url();?>bluehrd/user/index">Data Karyawan</a></li>
						<li><a href="<?php echo base_url();?>admin/attendance">Laporan Kehadiran</a></li>
						<li><a href="<?php echo base_url();?>admin/content?id_category=26">Limitless Learning</a></li>
						<li><a href="<?php echo base_url();?>admin/informasi">Pusat Informasi Karyawan</a></li>
						<li><a href="<?php echo base_url();?>admin/slipgaji">Slip Gaji</a></li>
					</ul>
				</li>
				<li><a href="<?php echo base_url();?>admin/options">Pengaturan</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-btn-group navbar-right">
				<li class="hidden"><a class="btn btn-primary-alt navbar-btn" href='<?php echo base_url(); ?>' target='_blank' rel='noopener noreferrer'>Lihat Situs</a></li>
				<li><a class="btn btn-primary-alt navbar-btn" href='<?php echo base_url();?>logout'>Keluar</a></li>
			</ul>
			<div class="hidden">
				<?php echo Modules::run('navigation/generate_menu', 5, 'admin-navigation'); ?>
			</div>
		</div>
	</nav>

	<section class="container-fluid container--navbar-fixed-top">

		<mp:Contentmain />

		<div class="clearfix"></div>
		
		<div class="footer">
			<ul class="list-inline">
				<li>Hak Cipta &copy; 2018 PT Bluebird TBK</li>
				<li class="hidden"><a href="#">Tentang</a></li>
				<li class="hidden"><a href="#">Syarat &amp; Ketentuan</a></li>
				<li class="hidden"><a href="#">Kebijakan</a></li>
				<li class="hidden"><a href="#">Bantuan</a></li>
			</ul>
      	</div>

	</section>

	<script>
		$('.tip').tooltip();
	</script>
</body>
</html>
