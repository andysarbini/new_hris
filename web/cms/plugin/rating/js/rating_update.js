// set this variable in page 
//var _rating_just_show = true; = 
// 	true => jangan ada penambahan counter view
//  false=> penambahan counter view

var comment_page = 1;

$(document).ready(function(){
	
	get_rating_number();
});

// just show

function get_rating_number(){
	
	$(".rating").each(function(){
		
		var _this = $(this);
		
		var _p = {};
		
		_p['content_id'] = $(this).attr("content_id");
		
		_p['user_id'] = $(this).attr("user_id");
		
		if(_rating_just_show == undefined) var _rating_just_show = false;
		
		var _url = base_url() + "rating/" + (_rating_just_show ? "get" : "update/view/"+_p['content_id']);
		
		$.post( _url , _p, function(data){ 
		
			_this.html(data);
		
		},'html');
	});
}

function add_love(content_id){
	
	
	$.post(base_url()+"rating/update/love/"+content_id, {}, function(data){
	
		//if(data != false || data != null) 
		$(".rating").html(data);
	
	},"html");
}

function save_comment(){
	
	var _p = {
	
		'content_id':$('#inp_content_id').val(),
	
		'value':$('#inp_comment').val()
	};

	var url = base_url()+"rating/comment_save";

	$.post(url,_p,function(data){
		
		$('#inp_comment').val('');
		
		$('#list_comment').prepend(data);
		
		get_rating_number();
	
	},'html');
}

function load_comment_paging(){
	
	var url = base_url() + "rating/comment_page/"+$('#inp_content_id').val()+'/'+(++comment_page)+"";
	
	$.post(url, {}, 
		
		function(data){ 
		
		if(data == '') $('#btn_comment_page').hide();
		
		else $('#list_comment').append(data); 
		
	}, 'html');
}
