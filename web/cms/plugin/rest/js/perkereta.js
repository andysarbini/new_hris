$(document).ready(function(){
	$("#slc_perkereta").on("change",function(){ table_perkereta($("#slc_perkereta").val()); });
	generate_slc_kereta();
	table_perkereta(1);
});

function generate_slc_kereta(){
	var _ = slc_perkereta;
	$("#slc_perkereta").html( build_input_select(_,undefined, "class='opt_perkereta'") );
}

function table_perkereta(id){

	if(id == undefined) id = 1;

	_list = d_perkereta[id];

	var _ = '';

	$.each(_list, function(index, value){
		_ += "<tr>";
		_ += "<td>"+value.produk+"</td>";
		_ += "<td>"+value.alias+"</td>";
		_ += "<td>"+value.gambar+"</td>";
		_ += "<td>"+value.harga+"</td>";
		_ += "<td>"+value.tipe+"</td>";
		_ += "<td>"+ "<input type=\"checkbox\""+("1" == value.tersedia + "" ? " checked":"")+">"+"</td>";
		_ += "</tr>";

	});

	$('#produk_perkereta_table_body').html(_);
}
