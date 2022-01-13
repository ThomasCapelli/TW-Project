$(document).ready(function(){
    var menu = $("ul.menu");
    $("header > nav > div.menu").click(function () {
        if(menu.hasClass("visible")) {
            menu.removeClass("visible");
        } else {
            menu.addClass("visible");
        }
    });
    $("ul.menu li div").click(function () {
        menu.removeClass("visible");
    });
    $(window).scroll(function(){
        menu.removeClass("visible");
    });
});