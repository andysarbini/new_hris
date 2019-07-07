<br /><br /><br /><br /><br />
<div ></div>
<div>
	<form>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search">
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>

			</div>
			<div class="input-group-btn">
				<button class="btn btn-default" onclick="form_edit();">
					<i class="fa fa-add" aria-hidden="true"></i>
					Tambah Kereta
				</button>
			</div>

		</div>
	</form>
</div>
<br />
<div class="table-responsive">
	<table class="table table-condensed table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Nomor	</th>
				<th>Kota Awal</th>
				<th>Kota Tujuan</th>
				<th>Jam Berangkat</th>
				<th>Jam Tiba</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody id="kai_table_body">
		</tbody>
	</table>
	<center>
		<ul class="pagination pagination-lg">
			<li class="active" onclick="table_kai(1);"><a href="#">1</a></li>
			<li><a href="#" onclick="table_kai(2);">2</a></li>
			<li><a href="#" onclick="table_kai(3);">3</a></li>
			<li><a href="#" onclick="table_kai(4);">4</a></li>
			<li><a href="#" onclick="table_kai(5);">5</a></li>
		</ul>
	</center>
</div>

<!-- Modal Edit-->
<div id="form_edit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Data User</h4>
			</div>
			<div class="modal-body">

				<div class="form-horizontal">
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_nama">Nama</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_nama" placeholder="Enter Name">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_nomor">Nomor</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_nomor" placeholder="Enter Nomor">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_kota_awal">Kota Awal</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_kota_awal" placeholder="Enter Kota Awal">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_kota_tujuan">Kota Tujuan</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_kota_tujuan" placeholder="Enter Kota Tujuan">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_jam_berangkat">Jam Berangkat</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_jam_berangkat" placeholder="Jam Keberangakatan">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="inp_jam_tiba">Jam Tiba</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inp_jam_tiba" placeholder="Jam Tiba">
	</div>
</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
