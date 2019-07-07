<div class="page-header-btn-absolute">
	<div class="button-set pull-right">
		<ul class="list-inline">
			<?php if(@if_empty($atasan)){ ?><li><a class="btn btn-default"  type="button" href="<?php echo base_url()."cuti/persetujuan/";?>">PERSETUJUAN CUTI</a></li><?php } ?>
			<li><button class="btn btn-default"  type="button" onclick="show_form_cuti();false;">IZIN CUTI BARU</button></li>
		</ul>
	</div>
</div>

<div class="view-table-list">
	<div class="form-inline">
		<!-- Filter berdasarkan -->
		<label class="control-label" for="year">Filter berdasarkan</label>
		<div class="form-group">
			<label class="control-label sr-only" for="year">Pilih tahun</label>
			<select class="form-control" name="year" id="year">
			<?php
			$_slc_year	= $slc_year;
			$_now_year 	= date("Y");
			$_next_year	= $_now_year + 1;
			$_low_year	= @if_empty($lowest_year) ? $lowest_year : $_now_year ;
			for($i = $_low_year; $i <= $_next_year; $i++)
			echo "<option value='".$i."'".( $_slc_year == $i ? " selected":"" ).">".$i."</option>";
			?>
			</select>
		</div>
		<a class="btn btn-default"  type="button" onclick="load_user_list_cuti();">Tampilkan</a>
	</div>
	
	<table class="table" id="cuti-table">
		<thead>
			<tr>
				<!-- <th class="text-center no-sort">No.</th> -->
				<th>Jenis <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center">Tanggal Mulai <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center">Tanggal Akhir <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Hari <span class="fas fa-sort pull-right"></span> </th>
				<th class="hidden">Alasan <span class="fas fa-sort pull-right"></span> </th>
				<th>Pesan Atasan <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%">Status <span class="fas fa-sort pull-right"></span> </th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php
		$i = 1; #debug($tables);
		foreach($tables as $var=>$v) { debug($v);?>
			<tr>
				<!-- <td class="text-center"><?php // echo $i++;?></td> -->
				<td><a class="#" onclick="show_detail_cuti(<?php echo $v->cuti_id;?>);false;"><?php echo $v->type;?></a></td>
				<td class="text-center"><small><?php echo bbdate($v->tgl_from);?></small></td>
				<td class="text-center"><small><?php echo bbdate($v->tgl_to);?></small></td>
				<td class="text-center"><?php echo duration($v->tgl_from,$v->tgl_to);?></td>
				<td class="hidden"><?php echo $v->alasan;?></td>
				<td><?php echo $v->alasan_atasan;?></td>
				<td><?php echo status($v->status);?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						  <li><a class="#" onclick="show_detail_cuti(<?php echo $v->cuti_id;?>);false;">Lihat</a></li>
						</ul>
					</div>
				</td>
				
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_view_cuti">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Formulir Izin Cuti</h4>
	  </div>
	  <div id="div-view">
	  
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
		</div>
	</div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal_form_cuti">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Formulir Izin Cuti</h4>
	  </div>
	  <form action="<?php echo base_url()."cuti/save";?>" class="" id="form-cuti" enctype="multipart/form-data" method="post">
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label" for="">Jenis <sup class="text-danger">*</sup></label>
					<select class="form-control" name="type_id">
						<?php foreach($types as $var=>$v) echo "<option value='".$v->type_id."'>".$v->type." (".$v->quota.")"."</option>"; ?>
					</select>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group input-daterange">
							<label class="control-label" for="">Tanggal Mulai <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="tgl_from" name="tgl_from" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group input-daterange">
							<label class="control-label" for="">Tanggal Akhir <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control " required name="tgl_to" id="tgl_to">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="">Hari</label>
							<input type="text" class="form-control" readonly placeholder="" id="days" name="days">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="">Tersisa</label>
							<div id="tersisa" class="form-control form-control-none"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="alert alert-info hidden">
						<p><b>INFO:</b> Cuti ke <b>25</b> akan diambil dalam tahun ini, <b><span class="text-danger">65</span></b> hari dari total <b>55</b> hari untuk Jenis cuti ini</p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="">Berikan alasan Anda <sup class="text-danger">*</sup></label>
					<textarea class="form-control" name="alasan" id="alasan"></textarea>
				</div>
				<div class="form-group">
					<label class="control-label" for="">Upload dokumen</label>
					<input type="file" name="document" class="form-control form-control-upload">
					<span class="help-block">Maks. 10MB</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-default">Kirim</button>
			</div>
		</form>

	</div>
  </div>
</div>
