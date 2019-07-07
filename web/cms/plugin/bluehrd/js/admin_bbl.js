function delete_bbl(bbl_id){
	
	 if (confirm('Hapus ?')) {
		
		$.post(base_url()+"bluehrd/admin/bbl_delete",{'content_id':content_id}, function(data){ location.reload(); },'json');
	 }
}
