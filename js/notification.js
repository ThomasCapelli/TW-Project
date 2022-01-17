function ajaxBadge() {
    $.ajax({
        method: "POST",
        url: "../php/bootstrap.php",
    });
}
$(document).ready(function(){
    $(".addToCart").click(function (e) { 
        ajaxBadge();
    });
   
});