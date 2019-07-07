$(document).ready(function(){
	
	// $('#cuti-table').DataTable();
	$('#cuti-table').DataTable({
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

function modal_persetujuan(cuti_id, status){
	
	var url = base_url() + "cuti/detail/" + cuti_id;
	
	$.post(url, {}, function(data){
		
		$("#cuti_id").val(cuti_id);
		
		$("#cutiCuti").html(data);
		
		if(status != 1) $('.div-inp-persetujuan').hide();
		
		else $('.div-inp-persetujuan').show();
		
		$("#modal_persetujuan").modal();
		
	}, 'html'); 
}
