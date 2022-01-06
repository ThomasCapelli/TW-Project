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
        var modalNav = document.querySelector("body > nav");
        var list = document.querySelectorAll(".list");
        list.forEach((item) => item.addEventListener("click",activeLink));
        drop.addEventListener("click",showAccNav);
        modalNav.onclick = function(event) {
            $(".account_background").hide();
        };
        modalMain.onclick = function(event) {
            $(".account_background").hide();
        };
        $(window).scroll(function(){
            $(".account_background").hide();
        });    
    }
});

