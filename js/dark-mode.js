$(document).ready(function(){
    $(".switch").click(function(){
        check = $("input[name='chk[]']").is(":checked");
        if(check){
            $("body").addClass("dark_mode").removeClass("light_mode");
           /*  $(".icon").each(function(){
                $(this).css("filter","invert(100%)");
            }); */
            /* //Invert icon colors
            $(".icon").each(function(){
                if($(this).css("filter")=="0%" || $(this).css("filter")=="none"){
                    $(this).css("filter","invert(100%)");
                }
                if($(this).css("filter")=="100%"){
                    $(this).css("filter","none");
                }
            }); */
        }
        else{
            $("body").addClass("light_mode").removeClass("dark_mode");
           /*  $(".icon").each(function(){
                $(this).css("filter","");
            });  */
          /*   //Invert icon colors
            $(".icon").each(function(){
                $(this).css("filter","");
            }); */
        }
    });     
});