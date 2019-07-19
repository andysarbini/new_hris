
<form id="form" action="<?php echo base_url()."admin/informasi/save";?>" enctype="multipart/form-data" method="post">

	<input type="hidden" name="info_id" value="<?php echo @if_empty($info->info_id,0);?>"/>
	
	<div class="form-group">
		<label class="control-label" for="title">Judul</label>
		<input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="<?php echo @if_empty($info->title,"");?>">
	</div>

	<div class="form-group">
		<label class="control-label" for="company">Kategori</label>
		<select id="category" name="category" class="form-control"><?php echo gen_option_html($slc_category, @if_empty($info->category,""));?></select>
	</div>

<?php
	
	$_roles = array("company_id"=>array(), "jabatan_id"=>array() );
	
	foreach($role as $var=>$v) {
		
		if(!in_array($v->company_id, $_roles["company_id"] )) $_roles["company_id"] [] = $v->company_id;
		
		if(!in_array($v->jabatan_id, $_roles["jabatan_id"] )) $_roles["jabatan_id"][] = $v->jabatan_id;
	}
?>

	<div class="form-group">
		<label class="control-label" for="company">Perusahaan</label>
		<div class="clearfix"></div>
		<div class="columns-2">
			<ul class="list-unstyled">
				<?php
				
					$_a_slc_company = json_decode($slc_company,true);
					
				#	echo '<div class="checkbox">';
				#	echo '	<input type="checkbox" id="company_id_all"><label><b>Seluruh Perusahaan</b></label>';
				#	echo '</div>';
				
					foreach($_a_slc_company as $var=>$val){
						
						echo '<li>';
						echo '<div class="checkbox">';
						echo '	<input type="checkbox"'.(in_array($var, $_roles["company_id"]) ? " checked":"").' class="company_id" value="'.$var.'" id="company_id_'.$var.'" name="company_id[]"><label for="company_id_'.$var.'">'.$val.'</label>';
						echo '</div>';
						echo '</li>';
					}
				?>
			</ul>
		</div>
	</div>
	
	<div class="form-group"> 
		<label class="control-label" for="jabatan">Jabatan</label>
		<div class="clearfix"></div>
		<div class="columns-2">
			<ul class="list-unstyled">
				<?php
				
					$_a_slc_jabatan = json_decode($slc_jabatan,true);
					
				#	echo '<div class="checkbox">';
				#	echo '	<input type="checkbox" id="jabatan_id_all"><label><b>Seluruh Perusahaan</b></label>';
				#	echo '</div>';
				
					foreach($_a_slc_jabatan as $var=>$val){
						
						echo '<li>';
						echo '<div class="checkbox">';
						echo '	<input type="checkbox"'.(in_array($var, $_roles["jabatan_id"]) ? " checked":"").' class="jabatan_id" value="'.$var.'" id="jabatan_id_'.$var.'" name="jabatan_id[]"><label for="jabatan_id_'.$var.'">'.$val.'</label>';
						echo '</div>';
						echo '</li>';
					}
				?>
			</ul>
		</div>
	</div>
  
	<div class="form-group">
		<label class="control-label" for="exampleInputEmail1">Keterangan</label>
		<textarea class="form-control" id="description" name="description"><?php echo @if_empty($info->description,"");?></textarea>
	</div>
  
	<div class="form-group">
		<label class="control-label" for="file">Berkas</label>
		<input type="text" class="form-control" id="file_name" value='<?php echo @if_empty($info->file,"");?>' disabled>
		<div class="clearfix" style="margin-bottom: 5px;"></div>
		<input type="file" id="file" name="file" placeholder="File Upload">
	</div>

	<div class="form-group form-group-btn text-right">
		<input type="submit" class="btn btn-default" value="Simpan">
	</div>
</form>
