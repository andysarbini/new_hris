<form action="<?php echo base_url()."profile/save";?>" method="post" enctype="multipart/form-data">
	
	<input type="hidden" id="usr_id" name="usr_id" value="<?php echo $user->usr_id; ?>">

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group"> 
						<label class="control-label" for="nama_lengkap">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo @if_empty($user->nama_lengkap, "");?>" readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="usr_name">Nama Pengguna</label>
						<input type="text" name="usr_name" class="form-control" id="usr_name" value="<?php echo @if_empty($user->usr_name, "");?>" readonly>
						<div class="help-block">Yang digunakan untuk masuk</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
				<input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?php echo @if_empty($user->tgl_lahir, "");?>" readonly>
			</div>
			<div class="form-group">
				<label class="control-label" for="email_corporate">Email</label>
				<input type="text" name="email_corporate" class="form-control" id="email_corporate" value="<?php echo @if_empty($user->email_corporate, "");?>" readonly>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="usr_pass">Password</label>
						<input type="password" class="form-control" name="usr_pass" id="usr_pass">
						<div class="help-block" for="usr_pass">Kosongkan jika tidak ingin mengganti password</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="usr_pass">Ketik Ulang Password</label>
						<input type="password" class="form-control"  name="re_usr_pass" id="re_usr_pass">
						<label class="text-danger" for="usr_pass" id="equal-pass"></label>		
				  	</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label sr-only" for="usr_pass">Gambar Profil</label>
				<div class="row">
					<div class="col-md-4">
						<?php 
							if(@if_empty($user->profile_picture)) echo "<img class='img-responsive thumbnail' src='".img_thumb(base_url()."uploads/profile/".$user->profile_picture, 260,260)."'>";
						?>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<input type="file" name="picture" id="picture" class="form-control form-control-upload">
						<div class="help-block">Upload gambar rasio 1:1 dimensi maksimal 260x260 pixel</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group form-group-btn">
				<button type="submit" class="btn btn-default">Simpan</button>
				<a href="<?php echo base_url()."profile";?>" class="btn btn-link">Batal</a>
			</div>
		</div>
	</div>
</form> 
