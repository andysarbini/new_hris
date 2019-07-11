<div class="dropdown profile-element"> <span>
<?php $profile_pic = @if_empty($user->profile_picture, "no-avatar.png");?>
	<img alt="image" class="img-circle" src="<?php echo img_profile("uploads/profile/" . $profile_pic, 100,100); ?>" />
		</span>
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
	<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $user->nama_lengkap;?></strong>
		</span> <span class="text-muted text-xs block"><?php echo mdl_opt('bb_opt_jabatan',$user->jabatan);?> <b class="caret"></b></span> </span> </a>
	<ul class="dropdown-menu animated fadeInRight m-t-xs">
		<li><a href="<?php echo base_url()."profile";?>">Profile</a></li>
		<li><a href="<?php echo base_url()."slipgaji";?>">Slip Gaji</a></li>
		<li><a href="<?php echo base_url()."attendance";?>">Laporan Kehadiran</a></li>
		<li><a href="<?php echo base_url()."cuti";?>">Izin Cuti</a></li>
		<li class="divider"></li>
		<li><a href="<?php echo base_url()."logout"?>">Logout</a></li>
	</ul>
</div>