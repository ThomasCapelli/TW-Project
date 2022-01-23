function removeBadge() {
    $("a.account").children().last().remove();
    $("#messaggi a span").children().last().remove();
}
function closeAll() {
    $("body > ul").each(function() {
        if($(this).hasClass("visible")) {
            removeVisibleSection($(this));
        }
    }); 
}
function onClose() {
    $(".account_background").hide();
    $(".indicator").hide();
    closeAll();
    $(".list").each(function() {
        $(this).removeClass("active");
    });
}
function removeVisibleSection(element) {
    element.removeClass("visible");
    let li = element.children();
    let bool = false;
    li.each(function(){
        if($(this).hasClass("new")) {
            $(this).removeClass("new");
            bool = true;
        }
    });
    if(bool) {
        $.ajax({
            method: "POST",
            url: "../php/notify.php",
            data: {
                letta: "si"
            }, success: function () {
                removeBadge();
            }
        });
    }
}
function showList(current) {
    if(current.hasClass("visible")) {
        removeVisibleSection(current);
    } else {
        current.addClass("visible");
    }
    current.find(">:first-child").click(function() {
        removeVisibleSection(current);
    });
}
function showAccNav(){
    if ($(".account_background").css("display") == "none") {
        $(".account_background").css("display", "flex");
    }else {
        onClose();
    }
}
function activeLink(current){
    $(".indicator").css("display", "initial");
    current.addClass("active");
    current.nextAll().removeClass("active");
    current.prevAll().removeClass("active");
    if(current.is("#messaggi")) {
        showList($("ul.notify"));
        removeVisibleSection($("ul.history"));
    } else if(current.is("#storico")) {
        showList($("ul.history"));
        removeVisibleSection($("ul.notify"));
    } else {
        closeAll();
    }
}
$(document).ready(function(){
    $(".account_background").hide();
    if( $(".account").length){
        $(".list").click(function() {
            activeLink($(this));
        });
        $(".account").click(function() {
            showAccNav()
        });
        $("main").click(function(event) {
            onClose();
        });
        $(window).scroll(function(){
            onClose();
        });    
    }
});
