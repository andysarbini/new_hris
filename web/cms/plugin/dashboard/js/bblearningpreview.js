$(document).ready(function(){
    //Disable full page
    $("body").on("contextmenu",function(e){
        return false;
    });
    
    //Disable part of page
    $(".article-body").on("contextmenu",function(e){
        return false;
    });
});