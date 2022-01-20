$(document).ready(function(){
    function showAccNav(){
        if ($(".account_background").css("display") == "none") {
            $(".account_background").css("display", "flex");
        }else {
            $(".account_background").css("display", "none");
        }
    }
    function activeLink(){
        list.forEach((item) =>
        item.classList.remove("active"));
        this.classList.add("active");
    }
    $(".account_background").hide();
    var drop = document.querySelector(".account");
    if(drop!=null){
        var modalMain = document.querySelector("main");
        var list = document.querySelectorAll(".list");
        list.forEach((item) => item.addEventListener("click",activeLink));
        drop.addEventListener("click",showAccNav);
        modalMain.onclick = function(event) {
            $(".account_background").hide();
        };
        $(window).scroll(function(){
            if(!($("ul.notify").hasClass("visible") || $("ul.history").hasClass("visible"))){
                $(".account_background").hide();
            }
        });    
    }
});

