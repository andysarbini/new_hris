var _paging_counter = 1;

$(document).ready(function(){
    
    var category_id = document.getElementById('category_id');
    var cat = category_id.dataset.value;
    if(cat == "" || cat == " "){
        var cat = "undefined";
    }
    var keywords = document.getElementById('keywords');
    var key = keywords.dataset.value;
    if(key == "" || key == " "){
        var key = "undefined";
    }
    var page = 1;

    function load_forum_topic(cat,key,page)
    {
        $.ajax({
            url: base_url() + "ajax_pagination_forum/"+cat+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#data_list').html(data.data_list);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }
    
    load_forum_topic(cat,key,page);
    
    $(document).on("click", "#pagination_link .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var cat=arr[3]; // diganti 3 kalo online
        var key=arr[4]; // diganti 4 kalo online
        var page=arr[5]; // diganti 5 kalo online
        load_forum_topic(cat,key,page);
    });

   /*$('.nav-toggle').click(function () {
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                toggle_switch.html('Read More');
            } else {
                toggle_switch.html('Read Less');
            }
        });
    });*/
    
    // load comment forum when ready
    //load_rating_json();
    get_comment_f();
    
});

