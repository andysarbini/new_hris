<form action="<?php echo base_url()."attendance/admin/save/";?>" method="post">
	
	<div class="form-group">
		<label for="email">NIP</label>
		<input type="text" class="form-control" name="nip" value="<?php echo @if_empty($att->nip, "");?>">
	</div>
	
	<?php $_in = explode(@if_empty($att->tgl_in, ""));?>

	<div class='row'>
		<div class="form-group col-md-6">
			<label for="email">Tanggal Masuk</label>
			<input type="text" class="form-control inp-date" name="tgl_in" value="<?php echo $_in[0];?>">
		</div>
		<div class="form-group col-md-6">
			<label for="email">Jam Masuk</label>
			<input type="text" class="form-control inp-hour" name="jam_in" value="<?php echo $_in[1];?>">
		</div>
	</div>

	<?php $_out = explode(@if_empty($att->tgl_out, ""));?>

	<div class='row'>
		<div class="form-group col-md-6">
			<label for="email">Tanggal Keluar</label>
			<input type="text" class="form-control inp-date-time" name="tgl_out" value="<?php echo $_out[0];?>">
		</div>
		<div class="form-group col-md-6">
			<label for="email">Jam Keluar</label>
			<input type="text" class="form-control inp-hour" name="jam_out" value="<?php echo $_out[1];?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="email">Status</label>
		<select name="status" class="form-control">
		<?php echo gen_option_html($status,@if_empty($att->status,''));?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Simpan</button>
</form>
