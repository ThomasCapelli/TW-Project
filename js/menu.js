
$(document).ready(function(){
    var history = $("ul.history");
    var menu = $("ul.menu");
    var notify = $("ul.notify");
    $("header > nav > div.menu").click(function () {
        if(menu.hasClass("visible")) {
            menu.removeClass("visible");
            $("header > nav > div.menu a").empty().append('<img src="../icons/menu.png" alt="General menu open icon" class="icon" /><p>Menu</p>');
        } else {
            menu.addClass("visible");
            $("header > nav > div.menu a").empty().append('<img src="../icons/menu_close.png" alt="Close general menu icon" class="icon"><p>Close</p>');
        }
    });
    $(window).scroll(function(){
        menu.removeClass("visible");
        $("header > nav > div.menu a").empty().append('<img src="../icons/menu.png" alt="General menu open icon" class="icon" /><p>Menu</p>');
    });
    $("ul.notify li:first-of-type").click(function () { 
        notify.removeClass("visible");
    });
    $("ul.history li:first-of-type").click(function () { 
        history.removeClass("visible");
    });
    $("#storico").click(function () {
        notify.removeClass("visible");
        if(history.hasClass("visible")) {
            history.removeClass("visible");
        } else {
            history.addClass("visible");
        }
    });
    $("#messaggi").click(function () {
        history.removeClass("visible");
        if(notify.hasClass("visible")) {
            notify.removeClass("visible");
        } else {
            notify.addClass("visible");
        }
    });
});