<form method="post" action="<?php echo base_url()."cuti/admin/type_cuti_save/";?>">
	<div class="input-daterange">
		<input type="hidden" name="type_id" value="<?php echo @if_empty($type->type_id, 0);?>"> 
		
		<div class="form-group">
			<label for="exampleInputEmail1">Jenis Cuti</label>
			<input type="text" class="form-control" name="type" value="<?php echo @if_empty($type->type, "");?>" placeholder="Masukan nama jenis cuti">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Kuota</label>
			<input type="text" class="form-control" name="quota" value="<?php echo @if_empty($type->quota, "");?>" placeholder="Masukan jumlah hari">
		</div>		
	</div>
	<div class="form-group form-group-btn">
		<button type="submit" class="btn btn-default">Simpan</button>
	</div>
</form>
