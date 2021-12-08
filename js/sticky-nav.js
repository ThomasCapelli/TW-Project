$(document).ready(function(){
    window.onscroll = function() {StickNav()};
    var navbar = document.getElementById("stickyNav");
    var sticky = navbar.offsetTop;

    function StickNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
});
