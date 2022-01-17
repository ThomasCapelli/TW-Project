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
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
        $("main").addClass("content");
        $("#cartbutton").css("display", "initial");
    } else {
        navbar.classList.remove("sticky");
        $("main").removeClass("content");
        $("#cartbutton").css("display", "none");
    }
}
function adaptHeader() {
    if($(window).width() > 768 || ($(window).width() < 768 && $(".cart").val() === undefined)) {
        $(".logo").css("margin-left", "0");
    } else if($(window).width() <= 768) {
        $(".logo").css("margin-left", "55px");
    }
}
$(document).ready(function(){
    var navbar = document.getElementById("stickyNav");
    var sticky = navbar.offsetTop;
    adaptHeader();
    window.onresize = function() {
        adaptHeader();
    };
    window.onscroll = function() {
        StickNav(navbar, sticky);
    };
    selected();
});
