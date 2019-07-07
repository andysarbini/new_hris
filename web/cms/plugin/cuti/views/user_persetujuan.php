<div class="page-header">
	<div class="button-set pull-right hidden">
		<ul class="list-inline">
			<!-- <?php if(@if_empty($atasan)){ ?><li><a class="btn btn-default"  type="button" href="<?php echo base_url()."cuti/persetujuan/";?>">PERSETUJUAN CUTI</a></li><?php } ?> -->
			<li><button class="btn btn-default"  type="button" onclick="show_form_cuti();false;">IZIN CUTI BARU</button></li>
		</ul>
	</div>
	<h2>Persetujuan Izin Cuti</h2>
</div>

<ol class="breadcrumb">
	<li><a href="<?php echo base_url();?>">Dashboard</a></li>
	<li><a href="<?php echo base_url();?>cuti">Izin Cuti</a></li>
	<li>Persetujuan Izin Cuti</li>
</ol>

<div class="view-table-list">
	<div class="form-inline">
		<!-- Filter berdasarkan -->
		<label class="control-label" for ="year">Filter berdasarkan</label>
		<div class="form-group">
			<label class="control-label sr-only" for ="year">Pilih tahun</label>
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

	<table class="table table-valign" id="cuti-table">
		<thead>
			<tr>
				<th class="text-center no-sort">No.</th>
				<th>Nama <span class="fas fa-sort pull-right"></span> </th>
				<th>Jenis <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Tanggal Mulai <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Tanggal Akhir <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Hari <span class="fas fa-sort pull-right"></span> </th>
				<th>Alasan <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%">Status <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center no-sort">Berkas</th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php
		$i = 1;
		foreach($tables as $var=>$v) { debug($v);
				$_p = array(
						"nip"=>$v->nip,
						"id"=>$v->usr_id,
						"pic"=>$v->profile_picture,
						"nama"=>$v->nama_lengkap
					);
			?>
			<tr>
				<td class="text-center"><?php echo $i++;?></td>
				<td><?php echo $this->load->view("foto_nama_nip_id",$_p,true);?></td>
				<td><a class="#" onclick="modal_persetujuan(<?php echo $v->cuti_id;?>,<?php echo $v->status;?>);false;"><?php echo $v->type;?></a></td>
				<td class="text-center"><small><?php echo bbdate($v->tgl_from);?></small></td>
				<td class="text-center"><small><?php echo bbdate($v->tgl_to);?></small></td>
				<td class="text-center"><?php echo duration($v->tgl_from,$v->tgl_to);?></td>
				<td><?php echo $v->alasan;?></td>
				<td><?php echo status($v->status);?></td>
				<td><?php echo $v->document != '' ? "<a class='btn btn-default btn-xs' href='".base_url().'uploads/cuti/'.$v->document."' target='_blank' alt='".$v->document."'><span class='fas fa-download fa-fw' aria-hidden='true'></span> Download <span class='sr-only'>".substr($v->document, 0, 32)."</span></a>":"";?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						  <li><a class="#" onclick="modal_persetujuan(<?php echo $v->cuti_id;?>,<?php echo $v->status;?>);false;">Lihat</a></li>
						</ul>
					</div>
				</td>
				
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_persetujuan">
  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Persetujuan Izin Cuti</h4>
			</div>
			
			<form action="<?php echo base_url()."cuti/persetujuan_save";?>" class="" id="form-cuti" method="post">
				<input type="hidden" id="cuti_id" name="cuti_id">
				
				<div id="cutiCuti" ><!-- Pakai id --></div>

				<div class="modal-body">
					
					<div class="form-group div-inp-persetujuan">
						<label class="control-label" for="">Isikan pesan anda untuk pengguna ini</label>
						<textarea class="form-control" name="alasan_atasan"></textarea>
					</div>
					<div class="form-group div-inp-persetujuan">
						<label class="control-label" for="">Keputusan anda?</label>
						<select class="form-control" name="status">
							<option value="2">Setuju</option>
							<option value="0">Tolak</option>
						</select>
					</div>
					<div class="form-group form-group-btn">
						<button type="submit " class="btn btn-default div-inp-persetujuan">Simpan</button>
					</div>
			</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
				</div>
		</div>
  </div>
</div>
