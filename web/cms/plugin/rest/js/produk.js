$(document).ready(function(){
	table_produk();
});

function table_produk(page){
	if(page == undefined) page = 1;

	_prod = d_produk;

	var _ = "";
	$.each(_prod, function(index, value){
		_ += "<tr>";
		_ += "<td>"+value.produk+"</td>";
		_ += "<td>"+value.alias+"</td>";
		_ += "<td>"+value.sku+"</td>";
		_ += "<td>"+value_select(slc_produk_kategori, value.kategori)+"</td>";
		_ += "<td>"+value.barcode+"</td>";
		_ += "<td>"+value.gambar+"</td>";
		_ += "<td>"+value_select(slc_produk_satuan, value.satuan)+"</td>";
		_ += "<td>"+value.harga+"</td>";
		_ += "<td>";
		_ += "		<div class=\"btn-group\">";
		_ += "			<button type=\"button\" class=\"btn btn-primary\" onclick=\"form_edit("+value.id+");false;\">Edit</button>";
		_ += "			<button type=\"button\" class=\"btn btn-primary\">Hapus</button>";
		_ += "			<button type=\"button\" class=\"btn btn-primary\" onclick=\"form_pass("+value.id+");\">Ubah Password</button>";
		_ += "		</div>";
		_ += "</td>";
		_ += "</tr>";
	});

	$("#kai_table_body").html(_);
}

function form_edit(id){
	if(id != undefined){
		var _ = d_produk[id];
		console.log(_);
		$("#inp_id").val(_.id);
		$("#inp_produk").val(_.produk);
		$("#inp_alias").val(_.alias);
		$("#inp_sku").val(_.sku);
		$("#inp_barcode").val(_.barcode);
		$("#inp_kategori").html(build_input_select(slc_produk_kategori, _.kategori));
		$("#inp_harga").val(_.harga);
		$("#inp_satuan").html(build_input_select(slc_produk_satuan, _.satuan));
		$("#inp_dijual").html(build_input_select(slc_produk_dijual, _.dijual));
		$("#inp_gambar").val("");
	} else {
		$("#inp_id").val(0);
		$("#inp_produk").val("");
		$("#inp_alias").val("");
		$("#inp_sku").val("");
		$("#inp_barcode").val("");
		$("#inp_kategori").html(build_input_select(slc_produk_kategori));
		$("#inp_harga").val("");
		$("#inp_satuan").html(build_input_select(slc_produk_satuan));
		$("#inp_dijual").html(build_input_select(slc_produk_dijual));
		$("#inp_gambar").val("");
	}
	$("#form_edit").modal()
}
