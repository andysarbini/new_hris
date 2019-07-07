<div class="form-inline filter-on-top">
	<form action="" method="get">
		<label class="control-label" for="year">Pilh tahun</label>
		<div class="form-group">
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
		<button type="submit" class="btn btn-default">Tampilkan</button>
	</form>
</div>


<table class="table" id="cuti-table">
	<thead>
		<tr>
			<th>Bulan</th>
			<th>Keterangan</th>
			<th>Status</th>
			<th width="8%">Berkas</th>
			<!-- <th width="26px"><span class="sr-only">Actions</span></th> -->
		</tr>
	</thead>
	<tbody>
<?php
	$i = 1; #debug($tables);
	foreach($tables as $var=>$v) { ?>
		<tr>
			<td><?php echo $bulan[$v->bulan];?></td>
			<td><?php echo $v->summary;?></td>
			<td><?php echo $v->status;?></td>
			<td><?php echo $v->document ? "<a href='".base_url()."uploads/slip/".$v->document."' class='btn btn-default btn-xs'><span class='fas fa-download fa-fw' aria-hidden='true'></span> Download</a>":"";?></td>
			<!-- <td>
				<div class="dropdown pull-right">
					<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fas fa-cog fa-lg" aria-hidden="true"></span></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
					  <li><a class="#" onclick="show_detail_cuti(<?php //echo $v->cuti_id;?>);false;">Lihat</a></li>
					</ul>
				</div>
			</td> -->
		</tr>
<?php } ?>
	</tbody>
</table>


<div class="modal fade" tabindex="-1" role="dialog" id="modal_view_cuti">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Formulir Izin Cuti</h4>
			</div>
			<div id="div-view"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-default">Simpan</button>
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
						<label class="control-label" for="type_id">Jenis <sup class="text-danger">*</sup></label>
						<select class="form-control" name="type_id" id="type_id">
						<?php foreach($types as $var=>$v) echo "<option value='".$v->type_id."'>".$v->type." (".$v->quota.")"."</option>"; ?>
						</select>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group input-daterange">
								<label class="control-label" for="tgl_from">Tanggal Mulai <sup class="text-danger">*</sup></label>
								<input type="text" class="form-control" id="tgl_from" name="tgl_from" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group input-daterange">
								<label class="control-label" for="tgl_to">Tanggal Akhir <sup class="text-danger">*</sup></label>
								<input type="text" class="form-control " required name="tgl_to" id="tgl_to">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="days">Hari</label>
								<input type="text" class="form-control" readonly placeholder="" id="days" name="days">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="alasan">Berikan alasan Anda <sup class="text-danger">*</sup></label>
						<textarea class="form-control" name="alasan" id="alasan"></textarea>
					</div>

					<div class="form-group">
						<label class="control-label" for="document">Upload Berkas</label>
						<input type="file" name="document" id="document" class="form-control form-control-upload">
						<div class="help-block">Maks. 8MB</div>
					</div>

				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-default">Simpan</button>
				</div>

			</form>

		</div>
	</div>
</div>
