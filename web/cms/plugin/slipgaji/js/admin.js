var current_slip_id = 0;

$(document).ready(function(){
	// $("#slip-table").DataTable();
	$('#slip-table').DataTable({
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
});

// tampilkan modal form slipgaji
function form_slipgaji(){

	$('#modal_form_slip').modal();
}

// tampilkan detail slip gaji
function view_slipgaji(slip_id){
	
	var url = base_url()+"admin/slipgaji/detail/"+slip_id;
	
	$.post(url, {}, function(data){
		
		current_slip_id = slip_id;
		
		$('.modal-body').html(data);
		
		$('#modal_view_slip').modal();
		
	}, 'html');
	
	
}

// hapus slip gaji
function delete_slipgaji(){
	
	if(confirm('Anda yakin ingin menghapus ini?')){
	
		var url = base_url() + "admin/slipgaji/delete/" + current_slip_id;
		
		$.post(url, {}, function(data){
			
			location.reload();
		
		},'html');
	}
}
