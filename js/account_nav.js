function showAccNav(){
    if(window.innerWidth<=768){
        $(".dropdown-content").hide();
        if ($(".account_background").css("display") == "none") {
            $(".account_background").show();
        }else {
            $(".account_background").hide();
        }
    }
    if(window.innerWidth>768){
        $(".account_background").hide();
        if($(".dropdown-content").css("display") == "none"){
            $(".dropdown-content").show();
        }else{
            $(".dropdown-content").hide();
        }
    }
    w = window.innerWidth;
}
function activeLink(){
    list.forEach((item) =>
    item.classList.remove("active"));
    this.classList.add("active");
}
function resetDrop(){
    if(window.innerWidth<=768 && $(".dropdown-content").css("display") != "none"){
        $(".dropdown-content").hide();
        $(".account_background").show();

    }
    if(window.innerWidth>768 && $(".account_background").css("display") != "none"){
        $(".account_background").hide();
        $(".dropdown-content").show();
    }
    if(w<=768 && window.innerWidth>768){
        drop = document.querySelector(".login a");
        drop.addEventListener("click",showAccNav);
    }
}
$(".account_background").hide();
$(".dropdown-content").hide();
var w;
var drop = document.querySelector(".login");
var modalMain = document.querySelector("main");
var modalNav = document.querySelector("body > nav");
var list = document.querySelectorAll(".list");
list.forEach((item) => item.addEventListener("click",activeLink));
drop.addEventListener("click",showAccNav);
window.addEventListener("resize",resetDrop);
modalNav.onclick = function(event) {
    $(".account_background").hide();
    $(".dropdown-content").hide();
};
modalMain.onclick = function(event) {
    $(".account_background").hide();
    $(".dropdown-content").hide();
};
$(window).scroll(function(){
    $(".account_background").hide();
    $(".dropdown-content").hide();
});
