
$(document).on('click', '.remove_parent', function() {

    $(this).parent().parent().remove();
});

function add_field(obj,target){
	
	var html = $(obj).html();
	
	$(target).append(html);
}
