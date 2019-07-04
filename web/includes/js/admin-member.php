$(document).ready(function(){
	
	$('#btn-login-pass').click(function() { change_pass_login(); }); 
	
});

function change_pass_login(){
	$.post( 'load_list_widget',	{'pass-login': $('pass-login').val(), 'repass-login':$('repass-login').val() }, 
		function (data){ 
			$('#myModal').modal({'show':false});
		}, 
		"json"
	);
}
