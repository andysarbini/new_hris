var _page = 0;
var _perpage = 10;
$(document).ready(function(){
	load_notification();
});

function load_notification(){

	var url = base_url() + "notification/get/"+_page++;

	$.post(url, {}, function(data){
	
		var txt = "";
		
		for(i in data){
			
			if(parseInt(data[i].status) == 1) txt += "<b>";
			
			txt += "<a href='"+base_url()+"notification/read/"+data[i].notif_id+"'>"+data[i].title+"</a><br><br>";
			
			if(parseInt(data[i].status) == 1) txt += "</b>";
			
			if(parseInt(data[i].status) == 1) set_status(data[i].notif_id, data[i].status);
		}
		
		if(data.length < _perpage) $("#btn-load-notif").hide();
		
		$("#wrap-notif").append(txt);
	}, "json");
}

function set_status(notif_id, status){

	var url_status = base_url() + "notification/set_status/";
	
	var _s = {'notif_id':notif_id, 'status':0};
	
	$.post(url_status, _s, function(d){}, 'html');
}
