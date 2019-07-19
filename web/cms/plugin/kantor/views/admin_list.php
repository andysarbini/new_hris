<div class="page-header">
	<div class="button-set pull-right">
		<a class="btn btn-default" onclick="form_info();false;">TAMBAH BARU</span></a>
	</div>
	<h1>Pusat Informasi Karyawan <sup><span class="fas fa-shield-alt fa-fw" aria-hidden="true"></span></sup></h1>
	<p class="lead">Semua daftar pusat informasi karyawan</p>
</div>

<div class="view-table-list">
	<form action="<?php echo base_url()."admin/informasi";?>" method="get">
	
		<div class="form-inline">
			<!-- Filter berdasarkan -->
			<label class="control-label" for="company">Filter berdasarkan</label>
			
			<div class="form-group">
				<label class="control-label sr-only" for="company">Perusahaan</label>
				<select id="company" name="company_id" class="form-control">
					<option value="">Semua Perusahaan</option>
					<?php echo gen_option_html($str_company, @if_empty($info->company_id,$selected_company));?>
				</select>
			</div>
	
			<div class="form-group">
			<label class="control-label sr-only" for="jabatan">Jabatan</label>
				<select id="jabatan" name="jabatan_id" class="form-control">
					<option value="">Semua Jabatan</option>
					<?php echo gen_option_html($str_jabatan, @if_empty($info->jabatan_id,$selected_jabatan));?>
				</select>
			</div>
	
			<div class="form-group">
				<label class="control-label sr-only" for="jabatan">Kategori</label>
				<select id="jabatan" name="category_id" class="form-control">
					<option value="">Semua Kategori</option>
					<?php echo gen_option_html($str_category, @if_empty($info->category,$selected_category));?>
				</select>
			</div>
			<button type="submit" class="btn btn-default">Tampilkan</button>
		</div>
	
	</form>
	
	<div class="clearfix"></div>
	<!-- <button class="btn btn-info" >Tambah Informasi</button> -->
	<table class="table" id="data-table">
		<thead>
			<tr>
				<th>Judul <span class="fas fa-sort pull-right"></span> </th>
				<th>Kategori <span class="fas fa-sort pull-right"></span> </th>
				<th>Keterangan <span class="fas fa-sort pull-right"></span> </th>
				<th class="no-sort" class="no-sort">Berkas</span> </th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($tables as $var=>$v){ ?>
			<tr>
				<td><a onclick='form_info(<?php echo $v->info_id;?>);false'><?php echo $v->title;?></a></td>
				<td><?php echo $v->category ? $slc_category[$v->category]:'';?></td>
				<td><small><?php echo $v->description;?></small></td>
				<td><?php echo $v->file ? "<a href='".base_url().'uploads/info/'.$v->file."' class='btn btn-default btn-xs'><span class='fas fa-download fa-fw' aria-hidden='true'></span> Download<span class='sr-only'>".$v->file."</span></a>":"";?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
							<li><a onclick='form_info(<?php echo $v->info_id;?>);false'>Edit</a></li>
							<li class="divider"></li>
							<li><a onclick='info_delete(<?php echo $v->info_id;?>);false'><span class="text-danger">Hapus</span></a></li>
						</ul>
					</div>
				</td>
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Pusat Informasi Karyawan</h4>
      </div>
      <div class="modal-body"><!-- load content --></div>
    </div>
  </div>
</div>


