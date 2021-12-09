function selected(element) {
    $(element).addClass("selected");
    $(element).nextAll().removeClass("selected");
    $(element).prevAll().removeClass("selected");
}
$(document).ready(function(){
    window.onscroll = function() {StickNav()};
    var navbar = document.getElementById("stickyNav");
    var sticky = navbar.offsetTop;
    var links = document.querySelectorAll("body nav ul");
    $("body nav ul li ").click(function(){
        selected($(this));
    });

    function StickNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
            $("main").addClass("content");
        } else {
            navbar.classList.remove("sticky");
            $("main").removeClass("content");
        }
    }
});
