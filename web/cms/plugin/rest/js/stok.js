$(document).ready(function(){
	$("#slc_perkereta").on("change",function(){ table_stok($("#slc_perkereta").val()); });
	generate_slc_kereta();
	table_stok(1);
});

function generate_slc_kereta(){
	var _ = slc_perkereta;
	$("#slc_perkereta").html( build_input_select(_,undefined, "class='opt_perkereta'") );
}

function table_stok(id){

	if(id == undefined) id = 1;

	_list = d_stock[id];

	var _ = '';

	$.each(_list, function(index, value){
		_ += "<tr>";
		_ += "<td>"+value.produk+"</td>";
		_ += "<td>"+value.kategori+"</td>";
		_ += "<td>"+value.tglupdate+"</td>";
		_ += "<td>"+value.jumlah+" ("+value.satuan+")</td>";
	//	_ += "<td>"+value.spark+"</td>";
		_ += "<td>btn + btn -</td>";
		_ += "</tr>";

	});

	$('#stok_table_body').html(_);
}
