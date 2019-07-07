$(document).ready(function(){
	num_notification();
});


function num_notification(){

	var url = base_url() + "notification/num/";

	$.post(url, {}, function(num){ 
		
		if(parseInt(num) > 99) num = '99+';
		
		$("#num-notif").html(num);
	});
}
