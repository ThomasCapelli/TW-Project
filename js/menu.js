$(document).ready(function(){
    var menu = $("ul.menu");
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
});