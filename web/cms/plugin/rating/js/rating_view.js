// set this variable in page 
//var _rating_just_show = true; = 
// 	true => jangan ada penambahan counter view
//  false=> penambahan counter view

$(document).ready(function(){
	
});

// just show
$(".rating").each(function(){
	
	var _this = $(this);
	
	var _p = {};
	
	_p['content_id'] = $(this).attr("content_id");
	
	_p['user_id'] = $(this).attr("user_id");
	
	if(_rating_just_show == undefined) var _rating_just_show = true;
	
	var _url = base_url() + "rating/" + (_rating_just_show ? "get" : "update/view/"+_p['content_id']);
	
	$.post( _url , _p, function(data){ 
	
		_this.html(data);
	
	},'html');
});

// add love
$(".rating_love").on("click", function(){
	
	var _this = $(this);
	
	var _parent = _this.parent();
	
	var _p = {
		
			'content_id':$(this).attr("content_id"),
		
			'user_id':$(this).attr("user_id"),
		};

	$.post(base_url()+"rating/update/love", _p, function(data){
	
		if(data != false || data != null) _parent.html(data);
	
	},"html");
});



