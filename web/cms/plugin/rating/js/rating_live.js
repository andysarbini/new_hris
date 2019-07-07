// Action rating js that supported for ajax result 

$( document ).on( "click", "a.rating_love", function() {
    var _this = $(this);
    var _parent = _this.parent();
	var _p = {
			'content_id':$(this).attr("content_id"),
            'user_id':$(this).attr("user_id"),
            'size':$(this).attr("size"),
        };
        
	$.post(base_url()+"rating/update_ver2/love", _p, function(data){
	
		if(data != false || data != null) _parent.html(data);
	
	},"html");
});

$( document ).on( "click", "a.rating_love_forum", function() {
    var _this = $(this);
    var _parent = _this.parent();
	var _p = {
			'forum_id':$(this).attr("forum_id"),
            'user_id':$(this).attr("user_id"),
            'size':$(this).attr("size"),
        };
        
	$.post(base_url()+"rating/update_ver3/love", _p, function(data){
	
		if(data != false || data != null) _parent.html(data);
	
	},"html");
});