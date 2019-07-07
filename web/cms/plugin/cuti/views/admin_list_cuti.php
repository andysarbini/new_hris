<?php
    $slc_year = "";
    $_now_year 	= date("Y");
    $_next_year	= $_now_year + 1;
    $_low_year	= @if_empty($lowest_year) ? $lowest_year : $_now_year ;
		
    for($i = $_low_year; $i <= $_next_year; $i++)
        $slc_year .= "<option value='".$i."'".( $year == $i ? " selected":"" ).">".$i."</option>";
        
    $slc_month = "";
    
    for($i = 0; $i<13; $i++ ) 
		$slc_month .= "<option value='".$i."'".( $i == $month ? " selected":"" ).">".$bulan[$i]."</option>";
	

?>
<form action="<?php echo base_url()."admin/cuti";?>" method="get">
	<div class="page-header">
		<div class="button-set pull-right">
			<a class="btn btn-primary" href="<?php echo base_url()."admin/cuti/type";?>">JENIS CUTI</a>
		</div>
		<h1>Izin Cuti</h1>
		<p class="lead">Daftar semua pengajuan izin cuti yang diajukan pengguna</p>
	</div>
	<div class="view-table-list">
		<div class="form-inline">
			<label class="control-label" for="year">Pilih tahun</label>
			<div class="input-group">
				<select class="form-control" id="year" name="year">
					<?php echo $slc_year;?>
				</select>
			</div>
			<label class="control-label" for="month">Pilih bulan</label>
			<div class="input-group">
				<select class="form-control" id="month" name="month">
					<?php echo $slc_month;?>
				</select>
			</div>
			<button type="submit" class="btn btn-default">Tampilkan</button>
		</div>
	</form> 
	
	
	<?php debug($tables);?>
	
	<table class="table table-valign" id="cuti-table">
		<thead>
			<tr>
				<th width="15%">Nama <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center">Tanggal Mulai <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center">Tanggal Akhir <span class="fas fa-sort pull-right"></span> </th>
				<th class="text-center">Hari <span class="fas fa-sort pull-right"></span> </th>
				<th class="hidden">Alasan <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%">Atasan <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%">Status <span class="fas fa-sort pull-right"></span> </th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($tables as $var=>$v){ ?>
			<tr>
				<?php 
					$a = get_user(array("nip"=>$v->atasan_nip));
					debug($a, '$a');
					debug($v->atasan_nip, '$v->atasan_nip');
					
					$_p = array(
							"nip"=>$v->nip,
							"id"=>$v->usr_id,
							"pic"=>$v->profile_picture,
							"nama"=>$v->nama_lengkap
						);
					
					$_a = array(
							"nip"=>@if_empty($a->nip, ''),
							"id"=>@if_empty($a->usr_id, ''),
							"pic"=>@if_empty($a->profile_picture, ''),
							"nama"=>@if_empty($a->nama_lengkap, '')
						);
				?>
				
				
				<td><?php echo $this->load->view("foto_nama_nip_id",$_p,true);?></td>
				<td class="text-center"><small><?php echo $v->tgl_from;?></small></td>
				<td class="text-center"><small><?php echo $v->tgl_to;?></small></td>
				<td class="text-center"><?php echo duration($v->tgl_from,$v->tgl_to);?></td>
				<td class="hidden"><?php echo $v->alasan;?></td>
				<td><?php echo $a != null ? $this->load->view("foto_nama_nip_id",$_a,true):'';?></td>
				<td><?php echo status($v->status);?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
							<!-- <li><a>Lihat</a></li>
							<li><a>Edit</a></li> -->
							<!-- <li class="divider"></li> -->
							<li><a onclick="delete_data(<?php echo $v->cuti_id; ?>);false"><span class="text-danger">Hapus</span></a></li>
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLongTitle">Detail Karyawan</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
