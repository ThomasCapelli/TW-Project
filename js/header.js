$(document).ready(function(){
    var header = document.querySelector("body header nav");
    let canAdd = true;
    
    window.onresize = function(event) {
        if (window.innerWidth > 768 && canAdd == true) {
            header.innerHTML = '<div class="removable"><a href="#" ><img src="../icons/Logo.png" alt="logo" class="icon" /></a></div>' + header.innerHTML;
            canAdd = false;
        }
        else if (window.innerWidth <= 768) {
            canAdd = true;
            $(".removable").remove();
        }
    };
    if (window.innerWidth > 768) {
        canAdd = false;
    }
    else if (window.innerWidth <= 768) {
        canAdd = true;
        $(".removable").remove();
    }
    
});