$(document).ready(function(){
    load_table_absensi();
    $('#div-form-revisi').hide();
});

function load_table_absensi(){

    var _usr_id = $('#usr_id').val();
    var _year   = $('#year').val();
    var _month  = $('#month').val();
    var _url = base_url() + "attendance/admin/load_attendance_list/"+_usr_id+"/"+_year+"/"+_month;
    
    $.post(_url, {}, function(d){ $('#div-table-attendance').html(d); }, 'html');
}

function load_form_ubah(att_id, tgl_in){
    
    $('#div-form-revisi').hide();
	
	$('#dfr-date_in').html(tgl_in);
    $('#dfr-inp-date_in').val(tgl_in);
    $('#dfr-inp-att_id').val(att_id);
    //$('#dfr-inp-status').val(status);
    $('#div-form-revisi').show(1000);
}

function simpan_perubahan_status(){

    var _p = {
		'usr_id': $('#dfr-inp-usr_id').val(),
		'att_id': $('#dfr-inp-att_id').val(),
		'rev_id': $('#dfr-inp-rev_id').val(),
		'status': $('#dfr-inp-status').val(),
		'date_in': $('#dfr-inp-date_in').val()
	};
// console.log(_p);
    var _url = base_url() + "attendance/admin/revisi_simpan_ubah_status";

    $.post(_url, _p, function(d){
		
		if(d.status == 'success') load_table_absensi(); 
		
		alert(d.message);
        
    }, 'json');
}