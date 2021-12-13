$(document).ready(function(){
    $(".switch").click(function(){
        check = $("input[name='chk[]']").is(":checked");
        if(check){
            $("body").addClass("dark_mode").removeClass("light_mode");
        }
        else{
            $("body").addClass("light_mode").removeClass("dark_mode");
        }
    });     
});