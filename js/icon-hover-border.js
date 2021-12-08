$(document).ready(function(){   
    $("a").hover(function(){
        $(this).children(".icon").css("border-color","red");
    }, function(){
        $(this).children(".icon").css("border-color","transparent");
    });
});