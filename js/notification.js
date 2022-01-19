
function ajaxBadge() {
    $.ajax({
        url: 'bootstrap.php',
        type: 'POST',
        data: {
             id: "1"
        },success: function(response){
            $(".badge").text($(".badge").text() + 1);  
        }
    });
}
$(document).ready(function(){
    $(".addToCart").click(function(){
        ajaxBadge();
    });
});