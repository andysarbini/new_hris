$(document).ready(function(){
	
	//  $('#cuti-table').DataTable();
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

	//$('.input-daterange input').each(function() {
	$('.input-daterange').each(function() {
		
		$(this).datepicker({format:"dd-mm-yyyy", language: 'id'});
	});
	

});


$('.input-daterange').on('change',function(){
	
	var _1 = $('#tgl_from').val();
	
	var _2 = $('#tgl_to').val();
	
	var url= base_url() + "cuti/duration/" + _1 +"/"+ _2;
	
	$('#days').val('');
	
	$.post(url,{},function(data){ $('#days').val(data); },'text');
});

function load_user_list_cuti(){
	
	window.location = base_url() + "cuti/index/?year=" + $("#year").val();
}

function show_detail_cuti(_id){
	
	var url = base_url() + "cuti/detail/"+_id;
	
	$.post(url, {}, function(data){

		$("#div-view").html(data);

		$('#modal_view_cuti').modal();

	},'html');	
}

function show_form_cuti(){
	
	$('#modal_form_cuti').modal();
}

$('#tgl_from').change( function(){
	 
	var _tgl = $(this).val().split('-'); 
	
	var _year = _tgl[2];
	
	//alert(_year);
	var url = base_url() + "cuti/sisa/" + _year+"?format=text";
	
	$.post(url, {}, function(data){ $('#tersisa').html(data); },'text')
});
