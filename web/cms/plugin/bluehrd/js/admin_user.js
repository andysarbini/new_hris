$(document).ready( function () {
	
    // $('#data-table').DataTable();
    $('#data-table').DataTable({
        language: { 
            search: '',
            paginate: {previous: '<span class="fas fa-caret-left" aria-hidden="true"></span>', next: '<span class="fas fa-caret-right" aria-hidden="true"></span>'},
            emptyTable: '<h4>Tidak ada data yang tersedia</h4>',
            info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri',
            infoEmpty: 'Menampilkan 0 hingga 0 dari 0 entri'
        },
        "order": [],
        "columnDefs": [ {
        "targets"  : 'no-sort',
        "orderable": false,
        }]
    });
    
    $('.dataTables_filter input[type="search"]').attr('placeholder', 'Cari...');
    $('.dataTables_empty').addClass('text-center text-muted');
    
} );

function show_upload_form(){
	
	$('#myModal').modal();
}

function delete_data(id){

	if(confirm('Anda yakin ingin menghapus ini?')) {
	
		var url = base_url() + "bluehrd/user/hapus/"+id;
	
		$.post(url, {}, function(){
	
			location.reload();
		}, 'html');
	}
}
