$(document).ready(function(){ });

function attendance(position){
    
    var _p = {};
    // masuk
    if($('#att_id').val() == undefined) {
        _p.lat_in = position.coords.latitude;
        _p.lon_in = position.coords.longitude;
    }
    // keluar
    else {
        _p.lat_in = position.coords.latitude;
        _p.lon_in = position.coords.longitude;
	}
	var _url = base_url() + "attendance/api/absen/" + $('#att_id').val();
	
	$.post(_url, _p, function(d){
	
		if(d.status !== 'error') $("#btnAbsensi").attr("disabled", true); 
	
		alert(d.status+"\r\n"+d.message);

		if(d.status !== 'success') window.open(base_url() + "attendance/");
	
	}, 'json');
}

function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(attendance);
    } else { 
      alert( "Browser tidak mendukung Geolocation, silahkan gunakan browser lain");
    }
  }
  
  function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
  }
