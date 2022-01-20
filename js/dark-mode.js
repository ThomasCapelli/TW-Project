var light = '<span class="icon_A_nav"><img src="../icons/candle.png" alt="Light mode logo"/></span><span class="text_A_nav">Light mode</span>';
var dark = '<span class="icon_A_nav"><img src="../icons/candela_spenta.png" alt="Dark mode logo"/></span><span class="text_A_nav">Dark mode</span>';
function changeMode($text, $mode, $opposite) {
    $("body").addClass($mode+"_mode").removeClass($opposite+"_mode");
    $("li#light a").empty().append($text);
}
function ajaxPost($mode) {
    $.ajax({
        method: "POST",
        url: "../php/mode.php",
        data: {
            mode: $mode
        }, success: function() {
            if($mode == "light") {
                changeMode(light, $mode, "dark"); 
            } else {
                changeMode(dark, $mode, "light");
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