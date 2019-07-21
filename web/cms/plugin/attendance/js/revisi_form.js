$(document).ready(function(){
//	$('.input-daterange').datepicker();

	$('.datepicker').each(function() {
		$(this).datepicker({format:"yyyy-mm-dd", language: 'id'});
	});

	//$('datepicker').datepicker({format:"yyyy-mm-dd", language: 'id'});
});
