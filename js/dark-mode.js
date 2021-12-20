function bind() {
    $("div.removable").click(function(){
        if($("body").hasClass("light_mode")){
            $("body").addClass("dark_mode").removeClass("light_mode");
            $("div.removable img").remove();
            $("div.removable p").remove();
            $("div.removable").append('<img src="../Icons/candela_spenta.png" alt="Dark mode logo"/><p>dark mode</p>');
        }
        else{
            $("body").addClass("light_mode").removeClass("dark_mode");
            $("div.removable img").remove();
            $("div.removable p").remove();
            $("div.removable").append('<img src="../Icons/candela_accesa_colored.png" alt="Light Mode logo"/><p>light mode</p>');
        }
    });    
}
$(document).ready(function(){
    bind();
});