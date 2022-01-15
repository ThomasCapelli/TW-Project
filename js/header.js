function adaptHeader() {
    if($(window).width() > 768 || ($(window).width() < 768 && $(".cart").val() === undefined)) {
        $(".logo").css("margin-left", "2px");
    } else if($(window).width() <= 768) {
        $(".logo").css("margin-left", "56px");
    }
}
$(document).ready(function(){
    adaptHeader();
    window.onresize = function() {
        adaptHeader();
    };
});