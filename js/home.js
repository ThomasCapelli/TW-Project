$(document).ready(function(){
    $(window).resize(function(){
        if($(window).width()>768){
            $(".mx-auto").removeClass("d-block");
        }
        else {
            $(".mx-auto").addClass("d-block");
        }
    });
});