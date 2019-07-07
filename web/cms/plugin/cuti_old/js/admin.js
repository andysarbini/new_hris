$(document).ready(function(){
	
load_list_cuti();

$("#status").change(function(){ load_list_cuti(); });
$("#year").change(function(){ load_list_cuti(); });
});

function load_list_cuti(){

	var status 	= $("#status").val();

	var year 	= $("#year").val();

	$.post(base_url()+"cuti/admin/listcuti", {"status":status, "year":year}, function(data){

		var txt = template_table(data);

		$("#cuti-table-body").html(txt);
	}, "json");
}

function set_status(cuti_id,status){

	$.post(base_url()+"cuti/admin/setstatus", {"cuti_id":cuti_id, "status":status}, function(data){

		 console.log(data);
		
		if(data == "1" || data == 1) window.open(base_url()+"cuti/admin/index/"+$("#year").val()+"/"+$("#status").val(), "_self");
		
		else alert("Error setting status");
	}, "text");
}

function template_table(data){

	var txt = "";
	
	var _status = ["Di Tolak", "Menunggu","Di Setujui"];
	
	var _color = ["alert","info","success"];

	for(i in data){
	
		txt += "<tr>";
	
		txt += "<td>"+data[i].nama_lengkap +"</td>";

		txt += "<td>"+data[i].tgl_input +"</td>";

		txt += "<td>"+data[i].tgl_from+"</td>";
	
		txt += "<td>"+data[i].tgl_to+"</td>";
	
		txt += "<td>"+_status[data[i].status]+"</td>";

		txt += "<td>";
		
		txt += "<button onclick='set_status("+data[i].cuti_id+","+"2"+");false;' class='btn btn-success'>Terima</button>";
		
		txt += "<button onclick='set_status("+data[i].cuti_id+","+"0"+");false;' class='btn btn-danger'>Tolak</button>";

		txt += "</td>";
	
		txt += "</tr>";
	}
	
	return txt;
}
