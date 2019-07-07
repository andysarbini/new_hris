$(".day-number").on("click", function(){
	
	var _p = {
		//"att_id": $("#inp_attid").val(),
		"usr_id": $("#inp_usrid").val(),
		"year"	: $("#inp_year").val(),
		"month"	: $("#inp_month").val(),
		"date"	: $(this).html()
	};
	
	$.post(base_url()+"attendance/api/get_single_attendance", _p, function(data){
		
		$("#inp_attid").val(data.att_id);

		$("#ti-year").val(data.year_in);
		$("#ti-month").val(data.month_in);
		$("#ti-date").val(data.date_in);
		$("#ti-hour").val(data.hour_in);
		$("#ti-minute").val(data.minute_in);
		
		$("#to-year").val(data.year_out);
		$("#to-month").val(data.month_out);
		$("#to-date").val(data.date_out);
		$("#to-hour").val(data.hour_out);
		$("#to-minute").val(data.minute_out);
		
		$("#formModal").modal();
	
	},"json");
});


function opt_selected(obj, val_compare){
	
	if($(obj).att("value") != val_compare) $(obj).removeAtt("selected");
	
	else $(obj).att("selected","selected");
}

function save_attendance(){
	
	var _p = {};
	
	_p.time_in 	= $("#ti-year").val() + "-" + $("#ti-month").val() + "-" + $("#ti-date").val() + " " + $("#ti-hour").val() + ":" + $("#ti-minute").val();
	
	_p.time_out = $("#ti-year").val() + "-" + $("#to-month").val() + "-" + $("#to-date").val() + " " + $("#to-hour").val() + ":" + $("#to-minute").val();
	
	_p.status	= $("#att-status").val();
	
	_p.usr_id	= $("#inp_usrid").val();
	
	_p.att_id	= $("#inp_attid").val();
	
	$.post(base_url()+"attendance/admin/save", _p, function(data){
		
		if(parseInt(data)) window.location.href = base_url()+"attendance/admin/user/"+$("#inp_usrid").val()+"/"+$("#inp_year").val()+"/"+$("#inp_month").val()+"/";
		
		else alert("error update attendance");
		
	}, "text");
}

function delete_attendance(){
	
	var r = confirm("Hapus Attendance ?");
	if(r) {
		
		var _p = {"att_id":$("#inp_attid").val()};
		
		$.post(base_url()+"attendance/admin/delete", _p, function(data){
		
			if(parseInt(data)) window.location.href = base_url()+"attendance/admin/user/"+$("#inp_usrid").val()+"/"+$("#inp_year").val()+"/"+$("#inp_month").val()+"/";
			
			else alert("error delete attendance");
			
		},"text");
	}
}
