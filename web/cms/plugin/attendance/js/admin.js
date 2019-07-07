$(document).ready(function(){
	
	$(".inp-date").datepicker({format:"dd-mm-yyyy", endDate: '+1d', maxDate: 0, maxViewMode: 0, language: 'id'});
		
	// $("#att-table").DataTable();
	$('#att-table').DataTable({
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

// https://stackoverflow.com/questions/18545941/jquery-on-submit-event
// ... $(document).on('submit','form.remember' then it will also work for the DOM added later.
// https://stackoverflow.com/questions/9347282/using-jquery-preventing-form-from-submitting
// ... the e.preventDefault is the correct JQuery syntax
$(document).on('submit','#form_input',function(e){
	
	var error = form_validasi_input();
	
	if( error != '')  {
		
		alert(error);
		
		e.preventDefault();
	}
});

function form_validasi_input(){
	
	
	if($("#inp_nip").val() == '') return 'NIP harus diisi';
	
	if($("#inp_tgl_in").val() == '') return 'Tanggal harus diisi';
	
	if($("#inp_jam_in").val() == '') return 'Jam Masuk harus diisi';
	
	if($("#inp_jam_out").val() == '') return 'Jam Keluar harus diisi';
	
	
	//if($('.company_id:checked').serialize() == '') return 'Perusahaan harus dipilih';
	
	//if($('.jabatan_id:checked').serialize() == '') return 'Jabatan harus dipilih';
	
	//if($('#file_name').val() == '' && $('#file').val() == '' ) return 'Berkas harus ada';
	
	return '';
}

$(document).on('submit','#form_upload',function(e){
	
	var error = form_validasi_upload();
	
	if( error != '')  {
		
		alert(error);
		
		e.preventDefault();
	}
});

function form_validasi_upload(){
	
	if($('#inp_document').val() == '' ) return 'Berkas harus ada';
	
	return '';
}

function delete_attendance(att_id){
	
	var url = base_url() + "admin/attendance/delete/" + att_id;
	
	$.post(url, {}, function(data){ location.reload();  }, 'text');
}

function form_attendance( att_id ){
	
	if(att_id == undefined) att_id = '';
	
	var url	= base_url() + "attendance/admin/form/"+att_id;
	
	$.post(url, {}, function(data){

		if(data.att_id == undefined)  data.att_id = '';
		
		if(data.time_in == undefined) data.time_in = '';
		
		if(data.date_in == undefined) data.date_in = hariini();

		if(data.date_out == undefined) data.date_out = hariini();
		
		if(data.time_out == undefined) data.time_out = '';
		
		if(data.status == undefined) data.status = 'H';

		//var _out = data.time_out.split(" ");
		
		$('#inp_att_id').val(data.att_id);
		
		$('#inp_nip').val(data.nip);
		
		$('#inp_tgl_in').val(bbdate(data.date_in));
		
		$('#inp_jam_in').val(data.time_in);
		
		$('#inp_tgl_out').val(bbdate(data.date_out));
		
		$('#inp_jam_out').val(data.time_out);
		
		$('#inp_status').val(data.status);
		
		$('#form-attendance').modal({backdrop: 'static', keyboard: false});
		
	},'json');
}

function form_import(){
	
	$('#modalImportCsv').modal({backdrop: 'static', keyboard: false});
}

function bbdate(str_date){
	
	var _ = str_date.split("-");
	
	return _[2] +'-'+ _[1] +'-'+ _[0];
}

// https://stackoverflow.com/questions/1531093/how-do-i-get-the-current-date-in-javascript
function hariini(){
	
	var today = new Date();
	
	var dd = today.getDate();
	
	var mm = today.getMonth()+1; //January is 0!
	
	var yyyy = today.getFullYear();

	if(dd<10) dd = '0'+dd ;

	if(mm<10) mm = '0'+mm; 

	today = yyyy + '-' + mm + '-' + dd;
	
	return today;
}
