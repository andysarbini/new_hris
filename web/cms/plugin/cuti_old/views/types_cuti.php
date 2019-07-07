

<table class="table">
	<thead>
		  <tr><th>Jenis Cuti</th><th>Kuota</th><th>&nbsp;</th></tr>
	</thead>
	<tbody id="cuti-table-body">
<?php
	foreach($types as $var=>$v){
		echo "<tr>";
		echo "<td>".$v->type."</td>";
		echo "<td>".$v->quota."</td>";
		echo "<td>";
		echo "<button class='btn btn-info' onclick='edit_type_cuti(".$v->type_id.");false;'>Edit</button>";
		echo "<button class='btn btn-danger' onclick='delete_type_cuti(".$v->type_id.");false;'>Delete</button>";
		echo "</td>";
		echo "</tr>";
	}
?>
	</tbody>
</table>

<button class="btn btn-info" onclick="edit_type_cuti(0);false;">Tambah Jenis Cuti</button>



<div class="modal bd-example-modal-sm" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body-form">
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
