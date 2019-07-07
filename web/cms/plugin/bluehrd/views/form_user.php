<div class="page-header">
	<div class="button-set pull-right">
		<a class="btn btn-primary" href="<?php echo base_url()."bluehrd/user/index";?>">DAFTAR DATA KARYAWN</a>
	</div>
	<h1>Data Karyawan</h1>
	<p class="lead">Tambah atau edit data karyawan</p>
</div>

<div class="tab-wrapper">
	<ul class="nav nav-tabs" role="tablist" id="editor-tab">
		<li role="presentation" class="active"><a href="#detail">Detail</a></li>
		<li role="presentation"><a href="#options">Option</a></li>
		<li role="presentation"><a href="#profile-image">Gambar Profil</a></li>
		<li role="presentation"><a href="#others">Lainnya</a></li>
	</ul>
	
	<form action="<?php echo base_url()."bluehrd/user/save";?>" method="post" enctype="multipart/form-data" class="form-horizontal">
		<?php debug($user);?>
		<input type="hidden" id="usr_id" name="usr_id" value="<?php echo @if_empty($user->usr_id, 0); ?>">

		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="detail">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="">ID</label>
					<div class="col-sm-6">
						<input type="text" class="form-control form-control-none" value="<?php echo @if_empty($usr_id, "");?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="usr_name">Nama pengguna</label>
					<div class="col-sm-6">
						<input type="text" name="usr_name" class="form-control" id="usr_name" value="<?php echo @if_empty($user->usr_name, "");?>">
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="nip">NIP</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nip" name="nip" value="<?php echo @if_empty($user->nip, "");?>">
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="nama_lengkap">Nama Lengkap</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo @if_empty($user->nama_lengkap, "");?>">
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="tgl_lahir">Tanggal Lahir</label>
					<div class="col-sm-6 form-inline">
						<input type="text" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" value="<?php echo @if_empty(bbdate($user->tgl_lahir), "");?>">
						<div class="help-block">Format tanggal dd-mm-yyyy</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="options">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="usr_pass">Password</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="usr_pass" id="usr_pass">
						<div class="help-block">Isikan kolom ini untuk mengganti password</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="email_corporate">Email</label>
					<div class="col-sm-6">
						<input type="text" name="email_corporate" class="form-control" id="email_corporate" value="<?php echo @if_empty($user->email_corporate, "");?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="usr_access">Aktifkan</label>
					<div class="col-sm-6 form-inline">
						<select class="form-control" name="usr_access">
							<?php
								$_enable_user = array(array("id"=>1,"title"=>"Enable"),array("id"=>2,"title"=>"Disable")); 
								echo gen_option_html($_enable_user, @if_empty($user->usr_access));
							?>
						</select>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="profile-image">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="usr_pass">Upload Berkas</label>
					<div class="col-sm-6">
						<?php 
							if(@if_empty($user->profile_picture)) echo "<img class='lazy thumbnail' src='".img_thumb("uploads/profile/".$user->profile_picture, 260,260)."'>";
						?>
						<div class="clearfix"></div>
						<input type="file" name="picture" id="picture">
						<div class="help-block">Rasio gambar 1:1 dengan maks. 260 x 260 pixel</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="others">
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="posisi">Posisi</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="posisi" name="posisi" value="<?php echo @if_empty($user->posisi, "");?>">
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="atasan">NIP Atasan</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="atasan_nip" name="atasan_nip" value="<?php echo @if_empty($user->atasan_nip, "");?>">
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="tgl_masuk">Tanggal Masuk</label>
					<div class="col-sm-6 form-inline">
						<input type="text" class="form-control datepicker" id="tgl_masuk" name="tgl_masuk" value="<?php echo @if_empty(bbdate($user->tgl_masuk), "");?>">
						<div class="help-block">Format tanggal dd-mm-yyyy</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="company">Perusahaan</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="company" name="company" class="form-control"><?php echo gen_option_html($slc_company, @if_empty($user->company,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_company/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="tipe_karyawan">Tipe</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="tipe_karyawan" name="tipe_karyawan" class="form-control"><?php echo gen_option_html($slc_tipe_karyawan, @if_empty($user->tipe_karyawan,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_tipe_karyawan/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="jabatan">Jabatan</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="jabatan" name="jabatan" class="form-control"><?php echo gen_option_html($slc_jabatan, @if_empty($user->jabatan,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_jabatan/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="grade">Grade</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="grade" name="grade" class="form-control"><?php echo gen_option_html($slc_grade, @if_empty($user->grade,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_grade/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="level">Level</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="level" name="level" class="form-control"><?php echo gen_option_html($slc_level, @if_empty($user->level,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_level/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="cost_ctr">Cost Ctr</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="cost_ctr" name="cost_ctr" class="form-control"><?php echo gen_option_html($slc_cost_ctr, @if_empty($user->cost_ctr,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_cost_ctr/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="pool">Pool</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="pool" name="pool" class="form-control"><?php echo gen_option_html($slc_pool, @if_empty($user->pool,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_pool/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-2 control-label" for="status_karyawan">Status</label>
					<div class="col-sm-4">
						<div class="input-group">
							<select id="status_karyawan" name="status_karyawan" class="form-control"><?php echo gen_option_html($slc_status_karyawan, @if_empty($user->status_karyawan,""));?></select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_status_karyawan/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
				</div>
			</div>
			
  			<div class="form-group form-group-btn">
			  <div class='col-sm-6 col-sm-offset-2 button-set'>
			  	<button type="submit" class="btn btn-default">Simpan</button>
				<a type="button" class="btn btn-link"  href="<?php echo base_url()."bluehrd/user/index";?>">Batal</a>
			  </div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		// $('#title').keyup(function(){ gen_title_to_uri('#title', '#uri'); });
		
		$('#editor-tab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
		
	});
 </script>
 
