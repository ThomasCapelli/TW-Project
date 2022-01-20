function selected() {
    var item = document.querySelectorAll("body nav.stickynav ul li a");
    for(let i = 0; i < item.length; i++) {
        if(item[i].href === location.href) {
            $(item[i]).addClass("selected");
            $(item[i]).nextAll().removeClass("selected");
            $(item[i]).prevAll().removeClass("selected");
        }
    }
}
function StickNav(navbar, sticky) {
    var cartButton = $("#cartbutton");
    if (window.pageYOffset >= sticky) {
        navbar.addClass("sticky")
        $("main").addClass("content");
        cartButton.css("display", "initial");
    } else {
        navbar.removeClass("sticky");
        $("main").removeClass("content");
        cartButton.css("display", "none");
    }
}
$(document).ready(function(){
    var navbar = $("#stickyNav");
    var offset = navbar.offset().top;
    window.onscroll = function() {
        StickNav(navbar, offset);
    };
    selected();
});
