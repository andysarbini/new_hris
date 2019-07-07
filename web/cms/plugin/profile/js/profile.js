/**
 * check jika password dan retype password tidak sama
 * */

$("#re_usr_pass").keyup(function(){
	var pass 	= $("#field-password").val();
	var rpass 	= $("#field-repassword").val();
	
	if(pass != "" && rpass != "") {
		
		if(pass != rpass) $("#equal-pass").html("password dan repassword tidak sama");
		
		else $("#equal-pass").html("");
	}
});
