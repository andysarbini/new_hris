$(document).ready(function(){

    var keywords = document.getElementById('keywords');
    var key = keywords.dataset.value;
    if(key == "" || key == " "){
        var key = "undefined";
    }
    var category = "all";
    var page = 1;

    function load_bblearning_data_files(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_files/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#bblearning_files').html(data.file_list);
                $('#paging_files').html(data.pagination_link);
            }
        });
    }

    function load_bblearning_data_files_2(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_files/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#bblearning_files').html('');
                $('#bblearning_files').html(data.file_list);
                $('#paging_files').html('');
                $('#paging_files').html(data.pagination_link);
            }
        });
    }

    function load_bblearning_data_videos(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_videos/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#bblearning_videos').html(data.video_list);
                $('#paging_videos').html(data.pagination_link);
            }
        });
    }

    function load_bblearning_data_videos_2(category,key,page)
    {
        $.ajax({
            url:"ajax_pagination_videos/"+category+"/"+key+"/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#bblearning_videos').html('');
                $('#bblearning_videos').html(data.video_list);
                $('#paging_videos').html('');
                $('#paging_videos').html(data.pagination_link);
            }
        });
    }
    
    load_bblearning_data_files(category,key,page);
    load_bblearning_data_videos(category,key,page);
    
    $(document).on("click", "#paging_files .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var category=arr[3]; // diganti 3 kalo online
        var key=arr[4]; // diganti 4 kalo online
        var page=arr[5]; // diganti 5 kalo online
        load_bblearning_data_files(category,key,page);
    });

    $(document).on("change", "#category_selection_file", function(event){
        event.preventDefault();
        var selected = $(this).val();
        var category= selected;
        load_bblearning_data_files_2(category,key,page);
    });

    $(document).on("click", "#paging_videos .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var category=arr[3]; // diganti 3 kalo online
        var key=arr[4]; // diganti 4 kalo online
        var page=arr[5]; // diganti 5 kalo online
        load_bblearning_data_videos(category,key,page);
    });

    $(document).on("change", "#category_selection_video", function(event){
        event.preventDefault();
        var selected = $(this).val();
        var category= selected;
        load_bblearning_data_videos_2(category,key,page);
    });
    
});
