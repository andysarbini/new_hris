$(document).ready(function(){ });


function getLocation() {
	
	$('#btnAbsensi').hide();
	
	if(geoPosition.init()) geoPosition.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
	
	else {
		alert('<span class="error">Functionality not available</span>');
		$('#btnAbsensi').show();

	}
}
function success_callback(p){
    
    var _p = {};
	_p.att_id 	= $('#att_id').val();
	_p.lat 		= parseFloat( p.coords.latitude ).toFixed(6)
	_p.lon 		= parseFloat( p.coords.longitude).toFixed(6);
  	_p.office_id = $('#office_id').val();

	var _url = base_url() + "attendance/api/absen/" + $('#att_id').val();
	
	$.post(_url, _p, function(d){
	
		alert(d.status+"\r\n"+d.message);
		
		if(d.status !== 'error') {

			$("#btnAbsensi").attr("disabled", true); 

			window.open(base_url() + "attendance/", '_self');
		}
		else $("#btnAbsensi").show(); 
	}, 'json');
}

function error_callback(p) { alert('Aktipkan GPS Anda'); $("#btnAbsensi").show(); }	