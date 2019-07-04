<div class="page-header">
	<div class="button-set pull-right">
	<a class="btn btn-default" href="<?php echo base_url()."options/admin/form/null/array_2"?>">TAMBAH BARU</a>
	</div>
	<h1>Pengaturan</h1>
	<p class="lead">Daftar semua variable option yang dapat diubah</p>
</div>

<div class="row">
	<div class="col-md-12 view-table-list">
		<!-- Fake Filter berdasarkan -->
		<div class="form-inline">
			<label for="" style="visibility:hidden">Filter berdasarkan</label>
		</div>
		<table class="table" id="opt-table">
			<thead>
				<tr>
					<th>Option <span class="fas fa-sort pull-right"></span> </th>
					<!-- <th class="hidden">Value</th> -->
					<th class="no-sort">Keterangan</th>
					<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
				</tr>
			</thead>
			<tbody>
		<?php foreach($opts as $var=>$v){ ?>
		<tr>
			<td><a href="<?php echo base_url()."options/admin/form/".$v->OPT."/array_2"?>"><?php echo $v->OPT?></a></td>
			<!-- <td class="hidden"><?php echo $v->OPT_VAL?></td> -->
			<td><small><?php echo $v->OPT_KET?></small></td>
			<td>
				<div class="dropdown pull-right">
					<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						<li><a href="<?php echo base_url()."options/admin/form/".$v->OPT."/array_2"?>">Edit</a></li>
						<li class="divider"></li>
						<li><a onclick='delete_data(<?php echo $v->OPT_ID;?>);false'><span class="text-danger">Hapus</span></a></li>
					</ul>
				</div>
			</td>
		</tr>
		<?php } ?>
			</tbody>
		</table>
	</div>
	<!--
	<div class="col-md-4">
		<div class="alert alert-info">
			<p>Beberapa variable option selection dapat Anda ubah dan sesuaikan dengan kebutuhannya di sini. Misal, Anda ingin membuat pilihan untuk Jenis Kendaraan, masukkan kata kunci (<i>key</i>) yang <u>unik</u> serta nilainya (<i>value</i>).</p><br>
			<ul class="list-unstyled">
				<li>key = 0, value = - Pilih Jenis Kendaraan -</li>
				<li>key = 1, value = Sedan</li>
				<li>key = 2, value = SUV</li>
				<li>key = 3, value = APV</li>
				<li>key = 4, value = Bus</li>
				<li>key = 5, value = Truck</li>
			</ul>
			<br>
			<div class="form-group">
				<label class="control-label">Jenis Kendaraan</label>
				<select class="form-control" name="" id="">
					<option value="0">- Pilih Jenis Kendaraan -</option>
					<option value="1">Sedan</option>
					<option value="2">SUV</option>
					<option value="3">APV</option>
					<option value="4">Bus</option>
					<option value="5">Truck</option>
				</select>
			</div>
		</div>
	</div>
	-->
</div>
