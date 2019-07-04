function editform(id){
	$.post( base_url()+'acl/getModule/'+id+'/json',{},
		function(data){
			$('#in-module').val(data.name);
			$('#in-description').val(data.ket);
			$('#in-active').val(data.isactive);
			$('#in-id').val(data.id);
			$('#myModal').modal({ show: true });
		}, 'json'
	);
}

function addform(){
	$('#in-module').val('');
	$('#in-description').val('');
	$('#in-active').val('');
	$('#in-id').val(0);
	$('#myModal').modal({ show: true });
}

//$('#save').on('click',function(){
function saveform(){
	var data = {
		MDL_ID:$('#in-id').val(),
		MDL_NAME:$('#in-module').val(),
		MDL_KET:$('#in-description').val(),
		MDL_ISACTIVE:$('#in-active').val()
	};

	$.post(base_url()+'acl/save',data,function(d){
		if(parseInt(d)){
			location.reload();
		} else {
			alert('error save ...');
		}
	});
}//);

function deleteform(){
	var id = $('#in-id').val();

	if(confirm("Are you sure you want to delete this item?")){
			$.post(base_url()+'acl/delete/module', {MDL_ID:id},
            	function(data){
            		if(data) location.reload();
					else alert('error save ...');
            	},'json'
           );
	   }
}
