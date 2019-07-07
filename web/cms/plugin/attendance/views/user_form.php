<div class="page-header">
	<div class="button-set pull-right">
		<button class="btn btn-default" onclick="form_attendance();false;">TAMBAH BARU</button>
		<button class="btn btn-primary" onclick="form_import();false;" title="Import Data Laporan"><span class="fas fa-upload fa-fw"></span><span class="sr-only">IMPORT DATA</span></button>
	</div>
	<h1>Laporan Kehadiran</h1>
	<p class='lead'>Daftar laporan kehadiran karyawan</p>
</div>

<div class="view-table-list">
	<form method="get">
		<div class="form-inline">
			<!-- Filter berdasarkan -->
			<label class="control-label" for="date">Filter berdasarkan</label>
			
			<div class="form-group">
				<label class="control-label sr-only" for="date">Pilih tanggal</label>
				<input type="text" class="form-control inp-date" name="date" value="<?php echo $date;?>">
			</div>
			<input type="submit" class="btn btn-default" value="Tampilkan">
		</div>
	</form>
	
	<table class="table table-valign" id="att-table">
		<thead>
			<tr>
				<th width="15%">Nama <span class="fas fa-sort pull-right"></span> </th>
				<th>NIP <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Tanggal <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Jam Masuk <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Jam Pulang <span class="fas fa-sort pull-right"></span> </th>
				<!-- <th>Waktu Selesai <span class="fas fa-sort pull-right"></span> </th> -->
				<th width="8%" class="text-center">Status <span class="fas fa-sort pull-right"></span> </th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php
		$i = 1; debug($tables);
		$_sts = json_decode($status, true);
		foreach($tables as $var=>$v) { 
			debug($v, 'v');
			$_p 	= array(
						"nip"=>$v->nip,
						"id"=>$v->usr_id,
						"pic"=>$v->profile_picture,
						"nama"=>$v->nama_lengkap
					);
	?>
			<tr>
				<td><?php echo $this->load->view("cuti/foto_nama_nip_id",$_p,true);?></td>
				<td><?php echo $v->nip;?></td>
				<td class="text-center"><small><?php echo bbdate($v->date_in);?></small></td>
				<td class="text-center"><small><?php echo $v->time_in;?></small></td>
				<td class="text-center"><small><?php echo $v->time_out;?></small></td>
				<!-- <td><?php // echo bbdate($v->date_out);?></td> -->
				<td class="text-center"><?php echo $_sts[$v->status];?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
							<li><a onclick="form_attendance(<?php echo $v->att_id;?>);false;">Edit</a></li>
							<li class="divider"></li>
							<li><a onclick="delete_attendance(<?php echo $v->att_id;?>);false;"><span class="text-danger">Hapus</span></a></li>
						</ul>
					</div>
				</td>
				
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>

<!-- Modal Laporan -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="form-attendance" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Laporan Kehadiran</h4>
			</div>
			<form action="<?php echo base_url()."attendance/admin/save/";?>" method="post" id="form_input">
				<div class="modal-body">		
					<input type="hidden" value="0" name="att_id" id="inp_att_id"/>
						
					<div class="form-group">
						<label for="inp_nip" class="control-label">NIP</label>
						<input type="text" class="form-control" name="nip" id="inp_nip" value="">
					</div>
					<div class="form-group">
						<label for="inp_tgl_in" class="control-label">Tanggal</label>
						<input type="text" class="form-control inp-date" name="tgl_in" id="inp_tgl_in" value="">
						<div class="help-block">Format tanggal dd-mm-yyyy</div>
					</div>
					
					<div class='row'>
						<div class="form-group col-md-6">
							<label for="inp_jam_in" class="control-label">Jam Masuk</label>
							<input type="text" class="form-control inp-hour" name="jam_in" id="inp_jam_in" value="">
							<div class="help-block">Format waktu 00:00 (jam:menit)</div>
						</div>
						<div class="form-group col-md-6">
							<label for="inp_jam_out" class="control-label">Jam Pulang</label>
							<input type="text" class="form-control inp-hour" name="jam_out" id="inp_jam_out" value="">
							<div class="help-block">Format waktu 00:00 (jam:menit)</div>
						</div>
					</div>

					<div class="form-group">
						<label for="inp_status" class="control-label">Status</label>
						<div class="input-group">
							<select name="status" id="inp_status" class="form-control">
							<?php echo gen_option_html($status,'');?>
							</select>
							<span class="input-group-addon"><a class="text-muted" title="Tambah Option" href="<?php echo base_url()."admin/options/form/bb_opt_status_attendance/array_2";?>"><span class="fas fa-plus fa-fw" aria-hidden="true"></span><span class="sr-only">Tambah Option</span></a></span>
						</div>
					</div>
					<!-- <div class='row'>
						<div class="form-group col-md-6">
							<label for="tgl_out">Tanggal Keluar</label>
							<input type="text" class="form-control inp-date" name="tgl_out" id="inp_tgl_out" value="">
						</div>
					</div> -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-default">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal upload -->
<div class="modal fade " id="modalImportCsv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLongTitle">Upload Laporan</h4>
			</div>
			<div class="modal-body">
				<form method="post" id="form_upload" action="<?php echo base_url()."admin/attendance/import_csv";?>" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label sr-only"  for="exampleInputEmail1">Upload</label>
						<input class="form-control form-control-upload" type="file" name="document" name="inp_document" placeholder="Upload CSV file">
						<div class="help-block">Maks. 10MB</div>
					</div>
					<div class="form-check checkbox">
						<input type="checkbox" class="form-check-input" id="upload_laporan" name="header" value="true" checked>
						<label class="form-check-label" for="upload_laporan" >CSV dengan header</label>
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
