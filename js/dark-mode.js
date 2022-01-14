function darkMode(){
    $("body").addClass("dark_mode").removeClass("light_mode");
    $("li#light a").empty().append('<span class="icon_A_nav"><img src="../icons/candela_spenta.png" alt="Dark mode logo"/></span><span class="text_A_nav">Dark mode</span>');
}
function lightMode() {
    $("body").addClass("light_mode").removeClass("dark_mode");
    $("li#light a").empty().append('<span class="icon_A_nav"><img src="../icons/candle.png" alt="Light mode logo"/></span><span class="text_A_nav">Ligh mode</span>');
}
function ajaxPost($mode) {
    $.ajax({
        method: "POST",
        url: "../php/bootstrap.php",
        data: {
            mode: $mode
        }, success: function(response)
        {
            if($mode == "light") {
                lightMode();
            } else {
                darkMode();
            }
            
        }
    });
}
$(document).ready(function(){
    $("li#light").click(function(){
        if($("body").hasClass("light_mode")){
            ajaxPost("dark");
        }
        else {
            ajaxPost("light");
        }
    });
});