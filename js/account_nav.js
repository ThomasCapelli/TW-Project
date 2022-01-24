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
function showSnackBar(testo) {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text(testo);
    window.setInterval(function() {
        $("div.snackbar").hide();
    }, 4000);
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
        removeVisibleSection($("ul.profile"));
    } else if(current.is("#storico")) {
        showList($("ul.history"));
        removeVisibleSection($("ul.notify"));
        removeVisibleSection($("ul.profile"));
    } else if(current.is("#profilo")){
        showList($("ul.profile"));
        removeVisibleSection($("ul.notify"));
        removeVisibleSection($("ul.hisotry"));
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
    $(".progress").each(function (){
        var time=Math.floor(Math.random() * 10000) + 1000;
        const changeProgress = (progress) => {
            $(this).css("width",`${progress}%`);
            if(progress==100){
                var closestElement = targetElement.closest("li");
                var ajaxurl = '../php/notify.php';
                var data =  {'changeOrderStatus': 1, 'idO': parseInt(closestElement.attr("name"))};
                $.post(ajaxurl, data); 
                showSnackBar("Ordine n: "+parseInt(closestElement.attr("name"))+" consegnato!");
            }
        };
        var targetElement = $(this);
        setTimeout(() => changeProgress(22),time);
        setTimeout(() => changeProgress(45), time+1000);
        setTimeout(() => changeProgress(85), time+1500);
        setTimeout(() => changeProgress(100), time+1500);
        
    });
});
