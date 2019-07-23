<br />
<br />
<div class="row">
	<div class="col-md-4 col-sm-12 row">
		<div class='col-md-12'>
			<div class='col-md-4'>
				<?php $profile_pic = @if_empty($rev->profile_picture, "no-avatar.png");?>
				<img alt="image" class="img-circle" src="<?php echo img_profile("uploads/profile/" . $profile_pic, 100,100); ?>" />
			</div>
			<div class='col-md-8'>
				<h3><?php echo $rev->nama_lengkap;?></h3>
			</div>
			<div class='col-md-8'>
				<h4><?php echo mdl_opt('bb_opt_jabatan',$rev->jabatan);?></h4>
			</div>
		</div>
		<div class='col-md-12'>
			<table class='table table-striped'>
				<tbody>
					<tr>
						<th>Tanggal</th>
						<td>
						<?php 
							if($rev->date_from == $rev->date_to) echo $rev->date_from;
							else echo $rev->date_from ." To ". $rev->date_to;
						?>
						</td>
					</tr>
					<tr>
						<th>Jenis</th>
						<?php $_tipe_revisi = json_decode(mdl_opt('bb_opt_tipe_revisi'),true); ?>
						<td><?php echo $_tipe_revisi[$rev->rev_type_id];?></td>
					</tr>
					<tr><th colspan=2>Subjek</th></tr>
					<tr><td colspan=2><?php echo $rev->subjek;?></td></tr>
					<tr><th colspan=2>Keterangan</th></tr>
					<tr><td colspan=2><?php echo $rev->keterangan;?></td></tr>
					<tr>
						<th>File</th>
						<td><?php echo "<a href='".base_url().$upload_path.'/'.$rev->path_file."'>".$rev->path_file."</a>";?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12" style="padding:2em;">
			<form class='form-horizontal' role='form' method='post' action='<?php echo base_url().'attendance/admin/revisi_simpan';?>'>
				<input type='hidden' name='rev_id' value='<?php echo $rev->rev_id;?>'/>
	
				<div class="form-group">
					<label class='control-label' for="cat_title">Status</label>
					<div class=''>
						<select class="form-control" name="closed_status">
<?php 
	$_closed_status = json_encode(array('0'=>"Pending", "1"=>"Accept", "2"=>"Reject"));
	echo gen_option_html($_closed_status, $rev->closed_status);
?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class='control-label' for="cat_title">Pesan</label>
					<div class=''>
						<textarea class='form-control input-sm' name="closed_msg"><?php echo @if_empty($rev->closed_msg, '');?></textarea>
					</div>
				</div>
				<div class="form-group">
					<a href="<?php echo base_url()."attendance/admin/revisi";?>" class="pull-left btn btn-danger">Cancel</a>	
					<button type="submit" class="pull-right btn btn-info">Simpan</button>	
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">
		<input type="hidden" value="<?php echo $rev->usr_id;?>" id="usr_id" />
		<?php $_date = explode('-',$rev->date_from);?>
		<input type="hidden" value="<?php echo $_date[0];?>" id="year" />
		<input type="hidden" value="<?php echo $_date[1];?>" id="month" />
			<h3><?php echo $_date[0] ." ".mdl_opt( 'bb_opt_bulan', (int)$_date[1]);?></h3>
		<div class="col-md-12" id="div-table-attendance"></div>
	</div>
	<div class="col-md-4 col-sm-12">
		<div id="div-form-revisi">
			<h4>Ubah Status Absensi : <b><span id="dfr-date_in"></span></b></h4>
			
			<div class="form" role="form">
				<input type="hidden" value="<?php echo $rev->usr_id;?>" id="dfr-inp-usr_id"/>
				<input type="hidden" value="" id="dfr-inp-date_in"/>
				<input type="hidden" value="<?php echo $rev->rev_id;?>" id="dfr-inp-rev_id" />
				<input type="hidden" value="" id="dfr-inp-att_id" />
				<select class="form-control" id="dfr-inp-status">
<?php 
	$_abc = mdl_opt('bb_opt_tipe_revisi');
	echo gen_option_html($_abc, $rev->rev_type_id);
?>
				</select>
				<button class="btn btn-success form-control" onclick="simpan_perubahan_status();false;">Ubah</button>
			</div>
		</div>
	</div>
</div>
