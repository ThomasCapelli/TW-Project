function remove() {
    $(".size").removeClass("visible"); 
}
$(document).ready(function(){
    $("article header ul li").click(function () {
        $("header > div").empty().append($(this).html());
    });
    $("button:first-of-type").click(function () {
        if($(".size").hasClass("visible")) {
            remove(); 
        } else {
            $(".size").addClass("visible");
        }
    });
    $("main > article > header > ul > li").click(function () {
        $(this).nextAll().removeClass("imageselected");
        $(this).prevAll().removeClass("imageselected");
        $(this).addClass("imageselected");
        remove();
    });
    $(".size li").click(function () {
        remove()
    });
    $(window).scroll(function(){
        remove();
    });
});