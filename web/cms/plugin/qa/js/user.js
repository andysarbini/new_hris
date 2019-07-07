$(document).ready(function(){
/*
	$('#form_ask').validate({
		rules: {
			subjek:"required",
			pertanyaan:"required"
		},
		messages: {
			subjek:"Anda belum mengisi subjek",
			pertanyaan:"Anda Belum mengisi pertanyaan"
		}
	});
	
	
	$('#form_answer').validate({
		rules: {
			answer:"required"
		},
		messages: {
			
			answer:"harus diisi"
		}
	});
	
*/
});

$(document).on('submit','#form_qa',function(e){
	
	var error = form_validasi_input();
	
	if( error != '')  {
		
		alert(error);
		
		e.preventDefault();
	}
});

function form_validasi_input(){
	
	
	if($("#subjek").val() == '') return 'Judul harus diisi';
	
	if($("#ask").val() == '') return 'Pertanyaan harus diisi';
	
	return '';
}
