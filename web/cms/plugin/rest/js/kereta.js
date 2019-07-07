$(document).ready(function(){
	table_kai();
});

function table_kai(page){

	if(page == undefined) page = 1;

	kai_list = d_kereta;

	var tbl_kai = '';

	$.each(kai_list, function(index, value){
		tbl_kai += "<tr>";
		tbl_kai += "<td>"+value.nama+"</td>";
		tbl_kai += "<td>"+value.nomor+"</td>";
		tbl_kai += "<td>"+value.kota_awal+"</td>";
		tbl_kai += "<td>"+value.kota_tujuan+"</td>";
		tbl_kai += "<td>"+value.jam_berangkat+"</td>";
		tbl_kai += "<td>"+value.jam_tiba+"</td>";
		tbl_kai += "<td>";
		tbl_kai += "		<div class=\"btn-group\">";
		tbl_kai += "			<button type=\"button\" class=\"btn btn-primary\" onclick=\"form_edit("+value.id+");false;\">Edit</button>";
		tbl_kai += "			<button type=\"button\" class=\"btn btn-primary\">Hapus</button>";
		tbl_kai += "		</div>";
		tbl_kai += "</td>";
		tbl_kai += "</tr>";

	});

	$('#kai_table_body').html(tbl_kai);
}

function form_edit(id){

	if(id != undefined){

		// ajax user value
		var _kai = d_kereta[id];

		$("#inp_nama").val(_kai.nama);
		$("#inp_nomor").val(_kai.nomor);
		$("#inp_kota_awal").val(_kai.kota_awal);
		$("#inp_kota_tujuan").val(_kai.kota_tujuan);
		$("#inp_jam_berangkat").val(_kai.jam_berangkat);
		$("#inp_jam_tiba").val(_kai.jam_tiba);
	} else {
		$("#inp_nama").val("");
		$("#inp_nomor").val("");
		$("#inp_kota_awal").val("");
		$("#inp_kota_tujuan").val("");
		$("#inp_jam_berangkat").val("");
		$("#inp_jam_tiba").val("");
	}
	$("#form_edit").modal()
}
