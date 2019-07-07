$(document).ready(function(){

    var base_url = document.getElementById('base_url');
    var baseurl = base_url.dataset.value;

    var category_id = document.getElementById('category_id');
    var cat = category_id.dataset.value;
    if(cat == "" || cat == " "){
        var cat = "0";
    }
    var page = 1;

    function load_news_data(cat,page, baseurl)
    {
        $.ajax({
            url: baseurl+"ajax_pagination_news/"+cat+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#data_list').html(data.article_list);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }
    
    load_news_data(cat,page, baseurl);
    
    $(document).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var cat=arr[3]; // diganti 3 kalo online
        var page=arr[4]; // diganti 4 kalo online
        load_news_data(cat,page,baseurl);
    });
    
});