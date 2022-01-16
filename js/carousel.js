let slidePosition = 1;

function currentSlide(n) {
    SlideShow(slidePosition = n);
}
function SlideShow(n) {
    if (n > $(".Containers").length) {
        slidePosition = 1;
    }
    if (n < 1) {
        slidePosition = $(".Containers").length;
    }
    $(".Containers").each(function() {
        $(this).css("display","none");
    });
    $(".dots").each(function() {
        $(this).css("enable","");
    });
    $(".Containers").each(function(index) {
        if(index == (slidePosition - 1)) {
            $(this).css("display", "block");
        }
    });
    $(".dots").each(function(index) {
        if(index == (slidePosition - 1)) {
            $(this).addClass("enable");
            $(this).prevAll().removeClass("enable");
            $(this).nextAll().removeClass("enable");
        }
    });
} 
$(document).ready(function(){
    SlideShow(slidePosition);
    window.setInterval(function() {
        SlideShow(slidePosition += 1);
    }, 4000);
    $("a").click(function(){
        if($(this).attr("class")=="back"){
            SlideShow(slidePosition += -1);
        }
        if($(this).attr("class")=="forward"){
            SlideShow(slidePosition += 1);
        }
    });
    $(".dots").click(function(){
        currentSlide($(this).index() + 1);
    });
});