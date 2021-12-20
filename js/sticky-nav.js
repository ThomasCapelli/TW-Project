function selected(element) {
    $(element).addClass("selected");
    $(element).nextAll().removeClass("selected");
    $(element).prevAll().removeClass("selected");
}
$(document).ready(function(){
    window.onscroll = function() {StickNav()};
    var navbar = document.getElementById("stickyNav");
    var sticky = navbar.offsetTop;
    $("body nav ul li ").click(function(){
        selected($(this));
    });
    function StickNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
            $("main").addClass("content");
            $("#cartbutton").css("display", "initial");
            console.log($("#cartbutton"));
        } else {
            navbar.classList.remove("sticky");
            $("main").removeClass("content");
            $("#cartbutton").css("display", "none");
        }
    }
});
