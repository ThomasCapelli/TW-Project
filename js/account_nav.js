let modalMain;
let list;

function removeVisible(element) {
    element.removeClass("visible");
}
function showList(current) {
    if(current.hasClass("visible")) {
        current.removeClass("visible");
    } else {
        current.addClass("visible");
    }
    current.find(">:first-child").click(function() {
        removeVisible(current);
    });
}
function showAccNav(){
    if ($(".account_background").css("display") == "none") {
        $(".account_background").css("display", "flex");
    }else {
        $(".account_background").css("display", "none");
    }
}
function activeLink(current){
    current.addClass("active");
    current.nextAll().removeClass("active");
    current.prevAll().removeClass("active");
    if(current.is("#messaggi")) {
        showList($("ul.notify"));
        removeVisible($("ul.history"));
    } else if(current.is("#storico")) {
        showList($("ul.history"));
        removeVisible($("ul.notify"));
    } else {
        var ul = $("body > ul");
        ul.each(function() {
            removeVisible($(this));
        }); 
    }
}
$(document).ready(function(){
    $(".account_background").hide();
    var drop = $(".account");
    if(drop.length){
        list = $(".list");
        list.click(function() {
            activeLink($(this));
        });
        drop.click(function() {
            showAccNav()
        });
        $("main").click(function(event) {
            $(".account_background").hide();
        });
        $(window).scroll(function(){
            if(!($("ul.notify").hasClass("visible") || $("ul.history").hasClass("visible"))){
                $(".account_background").hide();
            }
        });    
    }
});
