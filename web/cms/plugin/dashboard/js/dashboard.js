function load_article(num_page){
	var _url = base_url() + "dashboard/newsfeed.	";
	$.post();
}

$(document).ready(function(){

    function load_newsfeed_data(page)
    {
        $.ajax({
            url:"ajax_pagination_newsfeed/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#article_list').html(data.article_list);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }
    
    load_newsfeed_data(1);
    
    $(document).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var page=arr[3]; // diganti 3 kalo online
        load_newsfeed_data(page);
    });
    
});

function view_profile(){ }

