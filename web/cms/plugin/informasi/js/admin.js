$(document).ready( function () {
	
	// $('#data-table').DataTable({paging: false});
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

// https://stackoverflow.com/questions/18545941/jquery-on-submit-event
// ... $(document).on('submit','form.remember' then it will also work for the DOM added later.
// https://stackoverflow.com/questions/9347282/using-jquery-preventing-form-from-submitting
// ... the e.preventDefault is the correct JQuery syntax
$(document).on('submit','#form',function(e){
	
	var error = form_validasi();
	
	if( error != '')  {
		
		alert(error);
		
		e.preventDefault();
	}
});

function form_validasi(){
	
	
	if($("#title").val() == '') return 'Judul harus di isi';
	
	if($('.company_id:checked').serialize() == '') return 'Perusahaan harus dipilih';
	
	if($('.jabatan_id:checked').serialize() == '') return 'Jabatan harus dipilih';
	
	if($('#file_name').val() == '' && $('#file').val() == '' ) return 'Berkas harus ada';
	
	return '';
}

function form_info(id){
	
	if(id == undefined) id = '';
	
	var url = base_url() + "informasi/admin/form/"+id;
	
	$.post(url, {}, function(data){
	
		$('.modal-body').html(data);
	
		$('#exampleModal').modal();
	},'html')
	
	
}

function info_delete(id){

	if(confirm('Anda yakin ingin menghapus ini?')) {
	
		var url = base_url() + "informasi/admin/delete/"+id;
	
		$.post(url, {}, function(){
	
			location.reload();
		}, 'html');
	}
}



