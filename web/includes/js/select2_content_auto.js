$(document).ready(function() {
 

 $("#e7").select2('data', { id: 8, title: 'fooz' }).select2({
         placeholder: "Search for a Menu",
         minimumInputLength: 1,
         ajax: {
             url: "foo/search/",
             dataType: 'json',
             quietMillis: 100,
             data: function (term, page) { // page is the one-based page number tracked by Select2 
                 return {
                     input: term, 
                 };
             },
             results: function (data, page) {
                return { results: data };
             }
         },
         formatResult: formatResult,
		 formatSelection: formatSelect,
         dropdownCssClass: "bigdrop" // apply css that makes the dropdown taller 

});
function formatResult(state) {
	
	return state.text;
}

function formatSelect(state) { 
	
	return state.text;
}

});




