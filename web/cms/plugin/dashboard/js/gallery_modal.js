$(".openModalLink").click(function(e) {
    e.preventDefault();       
    var pic_id = $(this).attr("data-id");
    load_pic_info(pic_id);
});

function load_pic_info(pic_id){
    $.ajax({
        type: "GET",
        url: '../ajax_get_picture/'+pic_id,
        dataType: 'json',
        success: function(data)
        {                 
         $('#modal_gallery .img-placeholder .image_src').html(data.picture_src);
         $('#modal_gallery #short_info').html(data.short_info);
         $('#modal_gallery p').html(data.picture_desc);
         $('#modal_gallery .caption li.text-info').html(data.total_pic_info);
         $('#modal_gallery .pager li.previous').html(data.button_prev);
         $('#modal_gallery .pager li#prev_id').addClass(data.class_disabled_prev);
         if(data.class_disabled_prev == "enabled"){
            $('#modal_gallery .pager li#prev_id').removeClass("disabled");
         }else{
            $('#modal_gallery .pager li#prev_id').addClass(data.class_disabled_prev);
         }
         $('#modal_gallery .pager li.next').html(data.button_next);
         if(data.class_disabled_next == "enabled"){
            $('#modal_gallery .pager li#next_id').removeClass("disabled");
         }else{
            $('#modal_gallery .pager li#next_id').addClass(data.class_disabled_next);
         }
         
         // comment here
         $.post( base_url() + 'rating/comment/g'+pic_id, {}, function(data){
			 $('#comment-form').html(data);
         },'html');
         
         // get rating number
         $.post(base_url() + 'rating/update/view/?format=json',{'content_id':'g'+pic_id}, function(data){ 
             if(data.rating.love == 'undefined' || data.rating.love == '0' || data.rating.love == 0){
                data.rating.love = "0";
             }
             if(data.rating.is_voted == true){
                var _txt = '<div class="text-center" id="txt_love"><div><span class="far fa-heart text-danger fa-2x"></span></div>';
                _txt += data.rating.love+'</div>';
             }else{
                var _txt = '<a onclick="add_love_g(\'g'+pic_id+'\');false;" style="text-decoration:none;">'+'<div class="text-center" id="txt_love"><div><span class="far fa-heart fa-2x"></span></div>';
                _txt += data.rating.love+'</div></a>';
             }
			 $('#modal_gallery .count-top li').html(_txt);
			 
		},'json');
        
         $('#modal_gallery').modal('show');
        }
    });
}

