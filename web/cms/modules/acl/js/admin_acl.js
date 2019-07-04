$(document).ready(function(){
	$('.table').DataTable( { "paging": false } );
	//$('#table-regional').DataTable(  );
	//$('table.table').DataTable({ "paging": false });
});



$('.checkbox_acl').change(function(){

    var data = {
		'viud':$(this).attr('viud'),
		'acl_id':$(this).attr('acl_id'),
		'checked':$(this).is(':checked'),
		'id_group':$('#id_group').val(),
		'id_module':$(this).attr('id_module')
	};

    $.post(base_url()+'acl/acl_crud', data, function(){},'json');
});

function change_group(){
		window.location = base_url() + "acl/index/"+$('#slc_group').val();
}
/*
$('#slc_group').change('change',function(){
	window.location = base_url() + "acl/index/"+$('#slc_group').val();
});
*/
