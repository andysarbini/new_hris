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

<div class="clearfix"></div>

<form  action="<?php echo base_url()."admin/slipgaji";?>" method="get">

	<div class="page-header">
		<div class="button-set pull-right">
			<a class="btn btn-default" onclick="form_slipgaji();">TAMBAH BARU</a>
		</div>
		<h1>Slip Gaji</h1>
		<p class="lead">Daftar semua slip gaji</p>
	</div>

	<div class="view-table-list">
		<div class="form-inline">
			<!-- Filter berdasarkan -->
			<label class="control-label" for="year">Filter berdasarkan</label>
			
			<div class="form-group">
				<label class="control-label sr-only" for="year">Pilih tahun</label>
				<select class="form-control" id="year" name="year">
					<?php echo $slc_year;?>
				</select>
			</div>
	
			<div class="form-group">	
				<label class="control-label sr-only" for="month">Pilih bulan</label>
				<select class="form-control" id="month" name="month">
					<?php echo $slc_month;?>
				</select>
			</div>
			
			<button type="submit" class="btn btn-default">Tampilkan</button>
	
		</div>
	
	</form>
	
	<div class="clearfix"></div>
	<?php debug($tables);?>
	
	<table class="table table-valign" id="slip-table">
		<thead>
			<tr>
				<th width="15%">Nama <span class="fas fa-sort pull-right"></span> </th>
				<th>Keterangan <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Status <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="no-sort">Berkas</th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($tables as $var=>$v){ ?>
			<tr>
				<?php 
					$a = get_user(array("nip"=>$v->nip));
					debug($a);
					
					$_p = array(
							"nip"=>$v->nip,
							"id"=>$v->usr_id,
							"pic"=>$v->profile_picture,
							"nama"=>$v->nama_lengkap
						);
					
					
				?>
				
				
				<td><?php echo $this->load->view("cuti/foto_nama_nip_id",$_p,true);?></td>
				<td><?php echo $v->summary;?></td>
				<td class="text-center"><?php echo $v->status;?></td>
				<td><?php echo $v->document ? "<a href='".base_url()."uploads/slip/".$v->document."' class='btn btn-default btn-xs'><span class='fas fa-download fa-fw' aria-hidden='true'></span> Download</a>":"";?></td>
				<td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
							<li><a onclick="view_slipgaji(<?php echo $v->slip_id;?>);false;">Lihat</a></li>
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
<div class="modal fade" id="modal_view_slip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLongTitle">Formulir Slip Gaji</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="delete_slipgaji();false;">Hapus Data Ini</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal_form_slip">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Formulir Slip Gaji</h4>
	  </div>
	  <form action="<?php echo base_url()."admin/slipgaji/save";?>" class="" id="form-slipgaji" enctype="multipart/form-data" method="post">
<div class="modal-body">
	
	<div class="form-group">
	  <label class="control-label" for="nip">NIP <sup class="text-danger">*</sup></label>
	  <input type="text" class="form-control" id="nip" name="nip" required>
	</div>
	
	<div class="row">
	  <div class="col-md-6">
		<div class="form-group input-daterange">
		  <label class="control-label" for="tahun">Tahun <sup class="text-danger">*</sup></label>
		  <select class="form-control" id="tahun" name="tahun"><?php echo $slc_year;?></select>
		</div>
	  </div>
	  <div class="col-md-6">
		<div class="form-group input-daterange">
		  <label class="control-label" for="bulan">Bulan <sup class="text-danger">*</sup></label>
		  <select class="form-control" id="bulan" name="bulan"><?php echo $slc_month;?></select>
		</div>
	  </div>
	</div>
	
	<div class="form-group">
	  <label class="control-label" for="summary">Keterangan</label>
	  <textarea class="form-control" name="summary" id="summary"></textarea>
	</div>
	<div class="form-group">
	  <label class="control-label" for="status">Status</label>
	  <select class="form-control" id="status" name="status">
		<option value='paid'>Paid</option>
		<option value='Pending'>Pending</option>
	  </select>
	</div>
	<div class="form-group">
	  <label class="control-label" for="document">Upload Dokumen</label>
	  <input type="file" name="document" class="form-control form-control-upload">
	  <span class="help-block">Maks. 8MB</span>
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
