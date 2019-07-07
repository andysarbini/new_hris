var  _paging_counter = 1;

$(document).ready(function(){
	load_rating_json(); // ini untuk mengubah jumlah love comment view
	get_comment_f();
});

function save_comment_g(){
	
	var _p = {
			
			'content_id':$('#inp_content_id').val(),
			
			'value':$('#inp_comment').val()
		};
	
	var url = base_url()+'rating/comment_save';
		
	$.post(url, _p, function(data){ $('#comment-form #list_comment li:first').before(data); $('#inp_comment').val('');}, 'html');
}

function add_love_g(content_id, target){
	
	$.post(base_url()+"rating/update/love/"+content_id+'?format=json', {}, function(data){
		var _txt = '<div class="text-center" id="txt_love"><span class="far fa-heart text-danger fa-lg"></span>&nbsp;';
			 _txt += data.rating.love+'</div>';
		$('#txt_love').html(_txt);
	
	},"json");
}

// load commentar by paging
function get_comment_f(){
	
	var content_id = $('#inp_content_id').val();
	
	var url = base_url()+'rating/comment/'+content_id+'/'+_paging_counter;
	
	_paging_counter++; // variable global set di script yg load
	
	$.post(url, {}, function(data){ console.log(data);$('#comment-form').append(data); if(data == '') $('#btn-load-more-comment').hide();},'html');
		
}

function load_rating_json(){
	
	var url = base_url() + "rating/get/" + $('#inp_content_id').val() +'?format=json' ;
	
	$.post(url, {}, function(data){
		
		var _love = '<span class="far fa-heart fa-fw">'+data.rating.love+'</span>';
		
		$("#li-love").html(_love);
		
		// untuk forum love
		$("#li-f-love").html(data.rating.love);
		
		var _view = '<span class="far fa-eye fa-fw">'+data.rating.view	+'</span>';
		
		$("#li-view").html(_view);
		
		// untuk forum view
		$("#li-f-view").html(data.rating.view);
		
		var _comment = '<span class="far fa-comment fa-fw">'+data.rating.comment+'</span>';
		
		$("#li-comment").html(_comment);
		
		// untuk forum comment
		$("#li-f-comment").html(data.rating.comment);
		
	}, 'json');
}

function add_love_f(){
	
	var content_id = $('#inp_content_id').val();
	
	var url = base_url()+"rating/update/love/"+content_id+'?format=json';
	
	$.post(url, {}, function(data){
		
		load_rating_json();
		
	},"json");
}

function save_comment_f(){
	
	var _p = {
			
			'content_id':$('#inp_content_id').val(),
			
			'value':$('#inp_comment').val()
		};
	
	var url = base_url()+'rating/comment_save';
		
	$.post(url, _p, function(data){ $('#comment-form').prepend(data); $('#inp_comment').val(''); load_rating_json();}, 'html');
}
