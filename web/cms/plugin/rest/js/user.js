
// setup global variable data
var d_user, d_group, d_kereta;

$(document).ready(function(){
	// load table
	table_user();
});


function table_user(page){
	if(page == undefined) page = 1;
	// change value here
	user_list = d_user;

	var tbl_usr = "";
	$.each(user_list, function(index, value){
		tbl_usr += "<tr>";
		tbl_usr += "<td>"+value.name+"</td>";
		tbl_usr += "<td>"+value.nip+"</td>";
		tbl_usr += "<td>"+value.username+"</td>";
		tbl_usr += "<td>"+value_select(slc_group, value.group)+"</td>";
		tbl_usr += "<td>"+value_select(slc_kereta, value.kereta)+"</td>";
		tbl_usr += "<td>";
		tbl_usr += "		<div class=\"btn-group\">";
		tbl_usr += "			<button type=\"button\" class=\"btn btn-primary\" onclick=\"form_edit("+value.id+");false;\">Edit</button>";
		tbl_usr += "			<button type=\"button\" class=\"btn btn-primary\">Hapus</button>";
		tbl_usr += "			<button type=\"button\" class=\"btn btn-primary\" onclick=\"form_pass("+value.id+");\">Ubah Password</button>";
		tbl_usr += "		</div>";
		tbl_usr += "</td>";
		tbl_usr += "</tr>";
	});
	$("#user_table_body").html(tbl_usr);
}

function form_edit(id){

	if(id != undefined){

		// ajax user value
		var _user = d_user[id];

		$("#inp_nama").val(_user.name);
		$("#inp_nip").val(_user.nip);
		$("#inp_username").val(_user.username);
		$("#inp_group").html(build_input_select(slc_group, _user.group));
		$("#inp_kereta").html(build_input_select(slc_kereta, _user.kereta));
		$("#grp_pass").hide();
		$("#grp_repass").hide();
	} else {
		$("#inp_nama").val("");
		$("#inp_nip").val("");
		$("#inp_username").val("");
		$("#inp_group").html(build_input_select(slc_group));
		$("#inp_kereta").html(build_input_select(slc_kereta));
		$("#grp_pass").show();
		$("#grp_repass").show();
	}
	$("#form_edit").modal()
}

function form_pass(id){
	if(id != undefined){

		// ajax user value
		var _user = d_user[id];

		$("#pass_nama").val(_user.name);
		$("#pass_nip").val(_user.nip);
		$("#pass_username").val(_user.username);
	} else {
		$("#pass_nama").val("");
		$("#pass_nip").val("");
		$("#pass_username").val("");
	}
	$("#form_pass").modal()
}
