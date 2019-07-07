$(document).ready(function(){

	load_history_cuti();

	$('.input-daterange input').each(function() {
	
		//$(this).datepicker('clearDates');
	
		$(this).datepicker({format:"yyyy-mm-dd"});
	});
	
	$("#year").on("change", function(){ load_history_cuti(); });
});

function load_history_cuti(){
	
	var thn = $("#year").val();
	
	$.post(base_url()+"cuti/year/"+thn, {}, 
		
		function(data){ 
		
			var table =	template_table_cuti(data); 

			$("#cuti-table-body").html(table);
		},"json"
	);
}

function template_table_cuti(data){
	
	var txt = "";
	
	var _status = ["Di Tolak", "Menunggu","Di Setujui"];
	
	var _color = ["alert","info","success"];

	for(i in data){
	
		txt += "<tr>";
	
		txt += "<td>"+data[i].type +"</td>";

		txt += "<td>"+data[i].tgl_from+"</td>";
	
		txt += "<td>"+data[i].tgl_to+"</td>";
		
		txt += "<td>"+data[i].days+"</td>";
		
		txt += "<td>"+data[i].alasan+"</td>";
	
		txt += "<td class='text-"+_color[data[i].status]+"'>"+_status[data[i].status]+"</td>";
	
		txt += "</tr>";
	}
	
	return txt;
}

function form_cuti(){

	$("#form-modal").toggle();
}
