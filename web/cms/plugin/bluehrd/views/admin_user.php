<!--
<div class="form-group row">
	<input type="text" class="col-md-10" id="find" placeholder="Search">
	<button class="btn btn-success col-md-1" placeholder="Search" onclick="user_find();false;">Seach</button>
	<a class="btn btn-info col-md-1" href="">Add User</a>
</div>
-->

<div class="page-header">
	<div class="button-set pull-right">
		<a class="btn btn-default" href="<?php echo base_url()."bluehrd/user/form";?>">TAMBAH BARU</a>
		<button class="btn btn-primary" onclick="show_upload_form();false;" title="Import Data Karyawan"><span class="fas fa-upload fa-fw" aria-hidden="true"></span> <span class="sr-only">IMPORT DATA KARYAWAN</span></button>
	</div>
	<h1>Data Karyawan</h1>
	<p class="lead">Daftar semua data karyawan</p>
</div>

<div class="view-table-list">
	<form method="get" action="<?php echo base_url()."bluehrd/user/";?>">
	
		<div class="form-inline">
			<!-- Filter berdasarkan -->
			<label class="control-label" for="company">Filter berdasarkan</label>
	
			<div class="form-group">
				<label class="control-label sr-only" for="company">Perusahaan</label>
				<select id="company" name="company" class="form-control"><?php echo gen_option_html($slc_json_company, @if_empty($company,""));?></select>
		  	</div>
	
			<button type="submit" class="btn btn-default">Tampilkan</button>
		</div>
		
	</form>
	
	<table class="table table-valign" id="data-table">
		<thead>
			<tr>
				<th width="15%">Nama <span class="fas fa-sort pull-right"></span> </th>
				<!-- <th class="text-center hidden">Tanggal Lahir</th> -->
				<th width="15%">Posisi <span class="fas fa-sort pull-right"></span> </th>
				<!-- <th width="15%">NIP Atasan <span class="fas fa-sort pull-right"></span> </th> -->
				<!-- <th class="text-center hidden">Tanggal Masuk</th> -->
				<th width="15%">Perusahaan</th>
				<th width="8%" class="text-center">Tipe <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%">Jabatan <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Grade <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Level <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%">Pool <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Status <span class="fas fa-sort pull-right"></span> </th>
				<!-- <th class="hidden">Email</th> -->
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php
	//dump_exit($users, '$users');
	
	if(count($users))
	foreach($users as $var=>$u){
		echo "<tr>";
		echo "<td>";
		echo "<div class='media'>";
		echo "<div class='media-left media-middle'>";
		echo "<a class='tip' title='".$u->nip."'>";
		$_img = img_thumb("uploads/profile/".@if_empty($u->profile_picture, "no-avatar.png"), 40,40);
		echo "<img class='lazy img-circle' src='".$_img."' data-original='".$_img."' />";
		//echo "<img style='height:100px;' class='lazy' src='".img_thumb("uploads/profile/".@if_empty($u->profile_picture, "no-avatar.png"), 260,260)."'><br />";
		echo "</a>";
		echo "</div>";
		echo "<div class='media-body'>";
		echo "<p>";
		echo "<a href='". base_url()."bluehrd/user/form/".$u->usr_id ."'>";
		echo $u->nama_lengkap;
		echo "</a>";
		echo "</p>";
		echo "</div>";
		echo "</div>";
		// echo "<td class='text-center hidden'><small>".bbdate($u->tgl_lahir)."</small></td>";
		echo "<td><small>".$u->posisi."</small></td>";
		// echo "<td><small>".$u->atasan_nip."</small></td>";
		// echo "<td class='text-center hidden'><small>".$u->tgl_masuk."</small></td>";
		echo "<td><small>".@$slc_company[$u->company]."</small></td>";
		echo "<td class='text-center'><small>".@$slc_tipe_karyawan[$u->tipe_karyawan]."</small></td>";
		echo "<td><small>".@$slc_jabatan[$u->jabatan]."</small></td>";
		echo "<td class='text-center'><small>".@$slc_grade[$u->grade]."</small></td>";
		echo "<td class='text-center'><small>".@$slc_level[$u->level]."</small></td>";
		echo "<td><small>".@$slc_pool[$u->pool]."</small></td>";
		echo "<td class='text-center'><small>".@$slc_status_karyawan[$u->status_karyawan]."</small></td>";
		// echo "<td class='hidden'><small>".$u->email_corporate."</small></td>";
		echo "<td>";
		echo "<div class='dropdown pull-right'>";
		echo "<a class='btn btn-xs' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fas fa-cog fa-lg'></i></a>";
		echo "<ul class='dropdown-menu' role='menu' aria-labelledby='actionmenu'>";
		echo "<li><a href='". base_url()."bluehrd/user/form/".$u->usr_id ."'>Edit</a><li>";
		echo "<li class='divider'></li>";
		echo "<li><a onclick='delete_data(".$u->usr_id .");false'><span class='text-danger'>Hapus</span></a><li>";
		//echo "<li><a href='". base_url()."attendance/admin/user/".$u->usr_id ."' class='btn btn-success'>Attendance</a></li>";
		echo "</ul>";
		echo "</div>";
		echo "</td>";
		echo "</tr>";
	}
	?>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>


<div id="myModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Import Data Karyawan</h4>
			</div>
			<div class="alert alert-info text-center">
				<h4>Format CSV wajib berisikan:</h4>
				<p>nip, nama_lengkap, tgl_lahir, posisi, atasan_nip, tgl_masuk, company, tipe_karyawan, jabatan, grade, level, cost_ctr, pool, status_karyawan, email_corporate, dan password.<br><br>Gambar profil bisa diperbarui setelah berkas berhasil diupload.<br><b>Password tidak boleh mengandung koma</b></p>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url()."bluehrd/user/import_csv";?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="document" class="control-label sr-only">File CSV</label>
						<input type="file" name="document" class="form-control form-control-upload" />
						<div class="help-block">Maks. 10MB</div>
				  </div>
					<button type="submit" class="btn btn-default">Upload Berkas</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
