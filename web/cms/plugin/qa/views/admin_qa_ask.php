<?php //dump($qa); exit();
/*
Dump => array(1) {
  [0] => object(stdClass)#23 (9) {
    ["post_id"] => string(2) "99"
    ["post_title"] => string(26) "Cheerson CX-30 User manual"
    ["post_uri"] => string(26) "cheerson-cx-30-user-manual"
    ["post_title_short"] => string(0) ""
    ["post_feature_image"] => string(0) ""
    ["post_description"] => string(22) "bb learning content 01"
    ["usr_name_input"] => string(5) "admin"
    ["post_input_date"] => string(19) "2018-04-10 09:53:22"
    ["cat_title"] => string(11) "BB Learning"
  }
}
/**/
?>

<div class="page-header">
	<h1>Ajukan Pertanyaan</h1>
	<p class="lead">Daftar semua pertanyaan</p>
</div>

<div class="view-table-list">
	<div class="form-inline">
		
		<form action="<?php echo base_url()."admin/qa/";?>" method="get">
			<!-- Filter berdasarkan -->
			<label class="control-label" for="year">Filter berdasarkan</label>
			
			<div class="form-group">
				<label class="control-label sr-only" for="year">Pilih tahun</label>
				<select class="form-control" name="year" id="year">
				<?php
					for($i=2018; $i<=date("Y"); $i++) echo "<option value='".$i."'".($i == $year ? " selected":"").">".$i."</option>"
				?>
				</select>
			</div>
			
			<button type="submit" class="btn btn-default">Tampilkan</button>
	
		</form>
	
	</div>
	
	<table class="table table-valign" id="table-ask">
		<thead>
			<tr>
				<th width="15%">Nama <span class="fas fa-sort pull-right"></span> </th>
				<th>Pertanyaan <span class="fas fa-sort pull-right"></span> </th>
				<th width="15%" class="text-center">Tanggal <span class="fas fa-sort pull-right"></span> </th>
				<th width="8%" class="text-center">Status <span class="fas fa-sort pull-right"></span> </th>
				<th width="26px" class="no-sort"><span class="sr-only">Actions</span></th>
			</tr>
		</thead>
		<tbody>
	<?php
		foreach($data as $var=>$v){
			$_p = array(
					"nip"=>$v->nip,
					"id"=>$v->usr_id,
					"pic"=>$v->profile_picture,
					"nama"=>$v->nama_lengkap
			);
			echo "<tr>";
			echo "<td>".$this->load->view("cuti/foto_nama_nip_id",$_p,true)."</td>";
			echo "<td><small>".$v->ask."</small></td>";
			echo "<td class='text-center'><small>".$v->tgl."</small></td>";
			echo "<td class='text-center'>".($v->status ? "<span class='label label-success'>Kirim Email</span>":"<span class='label label-danger'>Non Email</span>")."</td>";
			echo "<td>";
			echo "<div class='dropdown pull-right'>";
			echo "<a class='btn btn-xs' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fas fa-cog fa-lg'></i></a>";
			echo "<ul class='dropdown-menu' role='menu' aria-labelledby='actionmenu'>";
			echo "<li><a onclick='send_email(".$v->ask_id.");false;'>Kirim Email</a></li>";
			echo "<li class='divider'></li>";
			echo "<li><a onclick='delete_ask(".$v->ask_id.");false;'><span class='text-danger'>Hapus</span></a></li>";
			echo "</ul>";
			echo "</div>";
			echo "</td>";
			echo "</tr>";		
		}
	?>
		</tbody>
	</table>
</div>
