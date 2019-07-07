$(document).ready(function(){

    var keywords = document.getElementById('keywords');
    var key = keywords.dataset.value;
    if(key == "" || key == " "){
        var key = "undefined";
    }
    var category = "all";
    var page = 1;

    function load_gallery_data_files(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_gallery/files/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#gallery_files').html(data.data_list);
                $('#paging_files').html(data.pagination_link);
            }
        });
    }

    function load_gallery_data_files_2(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_gallery/files/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#gallery_files').html('');
                $('#gallery_files').html(data.data_list);
                $('#paging_files').html('');
                $('#paging_files').html(data.pagination_link);
            }
        });
    }

    function load_gallery_data_videos(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_gallery/videos/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#gallery_videos').html(data.data_list);
                $('#paging_videos').html(data.pagination_link);
            }
        });
    }

    function load_gallery_data_videos_2(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_gallery/videos/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#gallery_videos').html('');
                $('#gallery_videos').html(data.data_list);
                $('#paging_videos').html('');
                $('#paging_videos').html(data.pagination_link);
            }
        });
    }
    
    load_gallery_data_files(category,key,page);
    load_gallery_data_videos(category,key,page);
    
    $(document).on("click", "#paging_files .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var category=arr[4]; // diganti 4 kalo online
        var key=arr[5]; // diganti 5 kalo online
        var page=arr[6]; // diganti 6 kalo online
        load_gallery_data_files(category,key,page)
    });

    $(document).on("change", "#category_selection_file", function(event){
        event.preventDefault();
        var selected = $(this).val();
        var category= selected;
        load_gallery_data_files_2(category,key,page)
    });

    $(document).on("click", "#paging_videos .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var category=arr[4]; // diganti 4 kalo online
        var key=arr[5]; // diganti 5 kalo online
        var page=arr[6]; // diganti 6 kalo online
        load_gallery_data_videos(category,key,page)
    });

    $(document).on("change", "#category_selection_video", function(event){
        event.preventDefault();
        var selected = $(this).val();
        var category= selected;
        load_gallery_data_videos_2(category,key,page)
    });
    
});
