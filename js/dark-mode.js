$(document).ready(function(){
    $(".switch").click(function(){
        check = $("input[name='chk[]']").is(":checked");
        if(check){
            var body = document.getElementsByTagName("body");
            body.classList.addClass("dark_mode");
            body.classList.removeClass("light_mode");

            //Invert icon colors
            $(".icon").each(function(){
                if($(this).css("filter")=="none"){
                    $(this).css("filter","invert(100%)");
                }
            });
        }
        else{
            body.classList.addClass("light_mode");
            body.classList.removeClass("dark_mode");
            //Invert icon colors
            $(".icon").each(function(){
                $(this).css("filter","");
            });
        }
    });     
});