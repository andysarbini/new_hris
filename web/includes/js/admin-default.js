//$('.delete').click(function(){});


function confirm_dell(){
	return confirm('Hapus Data ini?');
}

function loader(){
	return "<center><img src='includes/img/loader.gif'/></center>"; // XX #$% DFRT dsdf
} 

function gen_uri(txt_src){
	
	var output = txt_src.replace(/[^a-zA-Z0-9]/g,' ').replace(/\s+/g,"-").toLowerCase();
	
	/* if more than $cut_char char, cut to $cut_char char */
	var cut_char = 84;
	output = output.substring(0, cut_char);
	
	/* remove first dash */ 
	if(output.charAt(0) == '-') output = output.substring(1);
	
	/* remove last dash */
	var last = output.length-1;
	if(output.charAt(last) == '-') output = output.substring(0, last);
	
	return output;
}

function gen_title_to_uri(src, dst){
	$(dst).val(gen_uri($(src).val()));
}

$(document).ready(function(){

	$('.delete').click(function(event) {
	    event.preventDefault();
	    if (confirm("Are you sure ?"))   {  
	       window.location = $(this).attr('href');
	    }
	});

});

//$(document).bind('click', '.select2',function(){ $('.select2').select2(); $('.select2').unbind('click'); console.log('fire ...'); });
