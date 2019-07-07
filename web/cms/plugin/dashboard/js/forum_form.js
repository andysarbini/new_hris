$(document).ready(function(){
    function load_forum_topic(page)
    {
        $.ajax({
            url: base_url() + "ajax_pagination_mytopic/"+page,
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#data_list').html(data.data_list);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }
    
    load_forum_topic(1);
    
    $(document).on("click", "#pagination_link .pagination li a", function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var arr=url.split('/');
        var page=arr[3]; // diganti 3 kalo online
        load_forum_topic(page);
    });

    $(document).on("click", ".open-DeleteDialog", function () {
        var post_id = $(this).data('id');
        var link_delete = base_url() + "delete-topic-forum/" + post_id;
        $(".modal-footer a").attr('href', link_delete);
        $('#modal_delete_forum').modal('show');
   });

});
