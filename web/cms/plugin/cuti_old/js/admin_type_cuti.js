$(document).ready(function(){

});

function edit_type_cuti(type_id){
	
	var url = base_url()+"cuti/admin/type_cuti/"+type_id;
	
	$.post(url, {}, function(data){ 
			
		$('#modal-body-form').html(data);
		
		$('#myModal').modal();
		
	}, 'html');
}

function delete_type_cuti(type_id){
	
	if(confirm("Hapus Jenis Cuti ?")){
		
		var url = base_url()+"cuti/admin/type_cuti_delete/"+type_id;

		$.post(url, {}, function(data){
		
			location.reload(); 
			
		},'html');
	}
}
