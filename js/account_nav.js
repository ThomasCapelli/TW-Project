function bindAcc(){
    const list = document.querySelectorAll(".list");
    $(".account_background").hide();
    document.querySelector("body header nav .login a").addEventListener("click",showAccountNav);
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
bindAcc();
window.addEventListener("resize",bindAcc);
