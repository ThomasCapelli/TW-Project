$(document).ready(function(){
    var header = document.querySelector("body header nav");
    let canAdd = true;
    
    window.onresize = function(event) {
        $(".switch").click(function(){
            check = $("input[name='chk[]']").is(":checked");
            if(check){
                $("body").addClass("dark_mode").removeClass("light_mode");
            }
            else{
                $("body").addClass("light_mode").removeClass("dark_mode");
            }
        });  
        if (window.innerWidth > 768 && canAdd == true) {
            header.innerHTML += `<span class="removable"><a href="#"><h1>Aratri.com</h1></a></span>`;
            header.innerHTML += `<div class="removable">
            <label class="switch">
            <input type="checkbox" name="chk[]">
            <span class="slider round"></span>
            <p>Dark Mode</p>
            </label>
        </div>`
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