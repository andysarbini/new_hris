<div class="page-header">
		<div class="button-set pull-right">
			<button class="btn btn-default" onclick="edit_type_cuti(0);false;">TAMBAH JENIS CUTI</button>
			<a class="btn btn-primary" href="<?php echo base_url()."admin/cuti";?>">IZIN CUTI</a>
		</div>
		<h1>Jenis Cuti</h1>
		<p class="lead">Daftar semua jenis cuti</p>
	</div>

<table class="table">
	<thead>
		  <tr>
				<th>Jenis Cuti</th>
				<th width="8%" class="text-center">Kuota</th>
				<th width="26px"><span class="sr-only">Actions</span></th>
			</tr>
	</thead>
	<tbody id="cuti-table-body">
<?php
	foreach($types as $var=>$v){
		echo "<tr>";
		echo "<td><a onclick='edit_type_cuti(".$v->type_id.");false;'>".$v->type."</a></td>";
		echo "<td class='text-center'><small>".$v->quota."<small></td>";
		echo "<td>";
		echo "<div class='dropdown pull-right'>";
		echo "<a class='btn btn-xs' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fas fa-cog fa-lg'></i></a>";
		echo "<ul class='dropdown-menu' role='menu' aria-labelledby='actionmenu'>";
		echo "<li><a onclick='edit_type_cuti(".$v->type_id.");false;'>Edit</a></li>";
		echo "<li class='divider'></li>";
		echo "<li><a onclick='delete_type_cuti(".$v->type_id.");false;'><span class='text-danger'>Hapus</span></a></li>";
		echo "</ul>";
		echo "</div>";
		echo "</td>";
		echo "</tr>";
	}
?>
	</tbody>
</table>



<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Formulir Jenis Cuti</h4>
      </div>
      <div class="modal-body" id="modal-body-form">
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
