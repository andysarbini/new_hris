<form action="<?php echo base_url()."bluehrd/admin/bbl/";?>" method="get">

<div class="page-header">
	<div class="button-set pull-right">
		<a href="<?php echo base_url(); ?>admin/content/add?param_bbl=true" class="btn btn-default">TAMBAH BARU</a>
		<a href="<?php echo base_url(); ?>admin/content?id_category=26" class="btn btn-primary">LIMITLESS LEARNING</a>
	</div>
	<h1>Limitless Learning <sup><span class="fas fa-shield-alt" aria-hidden="true"></span></sup></h1>
	<p class='lead'>Daftar semua butir limitless learning</p>
</div>

	<div class="form-inline">
		<!-- Filter berdasarkan -->
		<label class="control-label" for="company">Filter berdasarkan</label>
	
		<input type="hidden" name="category" id="category" value="<?php echo $param["category"];?>" />

		<div class="form-group">
			<label class="control-label sr-only" for="company">Perusahaan</label>
			<select class="form-control" name="company" id="company">
			<option value="">- Semua perusahaan -</option>
			<?php echo gen_option_html($slc_company, @if_empty($company.''));?>
			</select>
		</div>
		
		<div class="form-group">
			<label class="control-label sr-only" for="jabatan">Jabatan</label>
			<select class="form-control" name="jabatan" id="jabatan">
			<option value="">- Semua jabatan -</option>
			<?php echo gen_option_html($slc_jabatan, @if_empty($jabatan.''));?>
			</select>
		</div>
		
		<!--<div class="form-group">
			<select class="form-control" name="level" id="level">
			<option value="">- Semua level -</option>
			<?php //echo gen_option_html($slc_level, @if_empty($level.''));?>
			</select>
		</div>
		
		<div class="form-group">
			<select class="form-control" name="grade" id="grade">
			<option value="">- Semua grade -</option>
			<?php //echo gen_option_html($slc_grade, @if_empty($grade.''));?>
			</select>
		</div>-->
		
		<input type="submit" class="btn btn-default" value="Tampilkan" />
		
	</div>
</form>

<table id="data-table" class="table">
	<thead>
		<tr>
		<th>Judul <span class="fas fa-sort pull-right"></span> </th>
		<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
		</tr>
	</thead>
	<tbody>
<?php
if(count($lists)){
	
	$_company = json_decode($slc_company, true);
	$_jabatan = json_decode($slc_jabatan, true);
	//$_level 	= json_decode($slc_level, true);
	//$_grade 	= json_decode($slc_grade, true);
	
	foreach($lists as $var=>$v){
		echo "<tr>";
		$_c = base_url()."admin/content/edit/". $v->content_id."?param_bbl=true";
		echo "<td><a href='{$_c}'>".@if_empty($v->title, '')."</a></td>";
		echo "<td>";
		echo "<div class='dropdown pull-right'>";
		echo "<a class='btn btn-xs' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fas fa-cog fa-lg'></i></a>";
		echo "<ul class='dropdown-menu' role='menu' aria-labelledby='actionmenu'>";
		
		echo "<li><a href='{$_c}'>Edit</a></li>";
		echo "<li class='divider'></li>";
		echo "<li><a h='button' onclick=\"delete_bbl({$v->content_id});\"><span class='text-danger'>Hapus</span></a></li>";
		echo "</ul>";
		echo "</div>";
		echo "</td>";
		echo "</tr>";
	}
}
?>
	</tbody>
</table>
