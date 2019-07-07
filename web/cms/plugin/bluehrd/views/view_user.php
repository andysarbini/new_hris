<?php 
/*
Dump => object(stdClass)#26 (22) {
  ["usr_id"] => string(1) "3"
  ["nip"] => string(5) "T3B3T"
  ["nama_lengkap"] => string(5) "indra"
  ["tgl_lahir"] => string(10) "1985-04-11"
  ["posisi"] => string(11) "HR Director"
  ["atasan"] => string(8) "Director"
  ["atasan_nip"] => string(0) ""
  ["tgl_masuk"] => string(10) "2018-02-06"
  ["company"] => string(1) "1"
  ["tipe_karyawan"] => string(1) "1"
  ["jabatan"] => string(1) "1"
  ["grade"] => string(1) "1"
  ["level"] => string(1) "1"
  ["cost_ctr"] => string(1) "1"
  ["pool"] => string(1) "1"
  ["status_karyawan"] => string(1) "1"
  ["email_corporate"] => string(15) "g3n1k@yahoo.com"
  ["profile_picture"] => string(13) "no-avatar.png"
  ["usr_name"] => string(5) "g3n1k"
  ["usr_access"] => string(1) "1"
  ["usr_grp_name"] => string(4) "user"
  ["USR_GRP_DESC"] => string(56) "Kelompok pengguna Terdaftar dan yang diperbolehkan masuk"
}
}*/
//->profile_picture;
$_img = img_thumb("uploads/profile/".@if_empty($$user->profile_picture, "no-avatar.png"), 260,260);		
?>

<div class="page-header">
	<div class="button-set pull-right">
		<a class="btn btn-primary" href="<?php echo base_url()."bluehrd/user";?>">DAFTAR DATA KARYAWN</a>
	</div>
	<h1>Data Karyawan</h1>
	<p class="lead"><?php echo $user->nama_lengkap;?> (NIP: <?php echo $user->nip;?>)</p>
</div>

<div class="tab-wrapper">
	<ul class="nav nav-tabs" role="tablist" id="editor-tab">
		<li role="presentation" class="active"><a href="#detail">Detail</a></li>
		<li role="presentation"><a href="#options">Option</a></li>
		<li role="presentation"><a href="#profile-image">Gambar Profil</a></li>
		<li role="presentation"><a href="#others">Lainnya</a></li>
	</ul>

	<div class="form-horizontal tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="detail">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">ID</label>
				<div class="col-sm-6">
					<input type="text" class="form-control form-control-none" value="<?php echo $user->usr_id;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">Nama pengguna</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->email_corporate;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">NIP</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->nip;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">Nama Lengkap</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->nama_lengkap;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">Tanggal Lahir</label disabled>
				<div class="col-sm-6 form-inline">
					<input type="text" class="form-control" value="<?php echo bbdate($user->tgl_lahir);?>" disabled>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="options">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="usr_pass">Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" value="password" disabled>
					<div class="help-block">Isikan kolom ini untuk mengganti password</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="email_corporate">Email</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->email_corporate;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="usr_access">Aktifkan</label>
				<div class="col-sm-6 form-inline">
					<input type="text" class="form-control" value="<?php echo $slc_boolean[$user->usr_access];?>" disabled>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="profile-image">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="usr_pass">Upload Berkas</label>
				<div class="col-sm-6">
					<?php echo "<img class='lazy thumbnail'  src='".$_img."' data-original='".$_img."' />";?>
					<div class="clearfix"></div>
					<div class="help-block">Rasio gambar 1:1 dengan maks. 260 x 260 pixel</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="others">
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="posisi">Posisi</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->posisi;?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="atasan">NIP Atasan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?php echo $user->atasan_nip;?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="tgl_masuk">Tanggal Masuk</label>
				<div class="col-sm-6 form-inline">
					<input type="text" class="form-control" value="<?php echo $user->tgl_masuk;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="company">Perusahaan</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_company[$user->company];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="tipe_karyawan">Tipe</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_tipe_karyawan[$user->tipe_karyawan];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="jabatan">Jabatan</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_jabatan[$user->jabatan];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="grade">Grade</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_jabatan[$user->grade];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="level">Level</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_level[$user->level];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="cost_ctr">Cost Ctr</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_cost_ctr[$user->cost_ctr];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="pool">Pool</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_pool[$user->pool];?>" disabled>
				</div>
			</div>
			<div class="form-group"> 
				<label class="col-sm-2 control-label" for="status_karyawan">Status</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $slc_status_karyawan[$user->status_karyawan];?>" disabled>
				</div>
			</div>
		</div>

		<div class="form-group form-group-btn">
			<div class='col-sm-6 col-sm-offset-2 button-set'>
				<a class="btn btn-default" href="<?php echo base_url()."bluehrd/user/form/".$user->usr_id;?>">Edit</a>
				<a type="button" class="btn btn-link"  href="<?php echo base_url()."bluehrd/user/index";?>">Batal</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('#editor-tab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
		
	});
 </script>