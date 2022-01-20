function hideElement(element){
    element.removeClass("slide").next().slideUp(); 
}
function removeVisible(element) {
    element.removeClass("visible");
}
$(document).ready(function(){
    var menu = $("div.accordion");
    $("header > nav > div.menu").click(function () {
        if(menu.hasClass("visible")) {
            removeVisible(menu);
            hideElement($("div.accordion > button"));
            $("header > nav > div.menu a").empty().append('<img src="../icons/menu.png" alt="General menu open icon" class="icon" /><p>Menu</p>');
        } else {
            menu.addClass("visible");
            $("header > nav > div.menu a").empty().append('<img src="../icons/menu_close.png" alt="Close general menu icon" class="icon"><p>Close</p>');
        }
    });
    $(window).scroll(function(){
        hideElement($("div.accordion > button"));
        removeVisible(menu);
        $("header > nav > div.menu a").empty().append('<img src="../icons/menu.png" alt="General menu open icon" class="icon" /><p>Menu</p>');
    });
    $("div.accordion > button").click(function(){
        if($(this).hasClass("slide")){
            hideElement($(this));
        }
        else {
            $(this).addClass("slide").next().slideDown();
        }
    });
});