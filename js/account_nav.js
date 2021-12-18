/* function bindAcc(){
    var w = innerWidth;
    console.log(w);
    console.log(drop);
    if(w>768){
        $(".account_background").hide();
        function activeDropdown(){
            if($(".dropdown-content").css("display")=="none"){
                $(".dropdown-content").show();
            }else{
                $(".dropdown-content").hide();
            }
        }
        drop.addEventListener("click",activeDropdown);
    }
    else{
        $(".dropdown-content").hide();
        let list = document.querySelectorAll(".list");
        $(".account_background").hide();
        drop.addEventListener("click",showAccountNav);
        function showAccountNav(){
            if ($(".account_background").css("display") == "none") {
                $(".account_background").show();
            }else {
                $(".account_background").hide();
            }
        }
        function activeLink(){
            list.forEach((item) =>
            item.classList.remove("active"));
            this.classList.add("active");
        }
        list.forEach((item) => item.addEventListener("click",activeLink));
    }
    
}
var drop = document.querySelector(".login a");
bindAcc();
window.addEventListener("resize",bindAcc);
 */
function showAccNav(){
    console.log(drop);
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
    console.log(w);
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
var drop = document.querySelector(".login a");
var list = document.querySelectorAll(".list");
list.forEach((item) => item.addEventListener("click",activeLink));
drop.addEventListener("click",showAccNav);
window.addEventListener("resize",resetDrop);
