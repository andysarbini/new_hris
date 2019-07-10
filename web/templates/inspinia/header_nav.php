<nav class="navbar navbar-default navbar-fixed-top top-nav">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
			<li class=""><a href="<?php echo base_url();?>notification"><span class="far fa-bell fa-lg"></span> <span class="sr-only">Notifications</span> <sup><span id="num-notif" class="label label-info"></span> </sup> </a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="sr-only"><?php echo $user->nama_lengkap;?></span>
<?php $profile_pic = @if_empty($user->profile_picture, "no-avatar.png");?>
				<img src="<?php echo img_profile("uploads/profile/" . $profile_pic, 260,260); ?>" alt="image" class="img-profile">
			</a>
			<ul class="dropdown-menu">
				<li class=""><a href="<?php echo base_url()."profile";?>">Profil</a></li>
				<li class=""><a href="<?php echo base_url()."slipgaji";?>">Slip Gaji</a></li>
				<li class=""><a href="<?php echo base_url()."attendance";?>">Laporan Kehadiran</a></li>
				<li class=""><a href="<?php echo base_url()."cuti";?>">Izin Cuti</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="<?php echo base_url()."logout"?>"><span class="text-danger">Keluar</span></a></li>
			</ul>
			</li>
		</ul>
		<form class="navbar-form navbar-right" action="<?php echo base_url()."search";?>" method="POST">
			<div class="form-group">
				<span class="fas fa-search fa-fw fa-lg" aria-hidden="true"></span>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="keywords" placeholder="Temukan yang Anda cari">
			</div>
			<span class="form-group-btn">
				<button type="submit" class="btn btn-default"><span class="fas fa-search fa-lg"></span> </button>
			</span>
		</form>
	</div>
</nav>
