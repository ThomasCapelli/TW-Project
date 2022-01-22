function addMessage(activeColor,activeSize) {
    $("<li class='new'>Hai aggiunto a carrello: "+$(".productName").text()+" Taglia: "+activeSize+" Colore: "+activeColor+"</li>").insertAfter("ul.notify li:first-of-type");
}
function showSnackBar(testo) {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text(testo);
    window.setInterval(function() {
        $("div.snackbar").hide();
    }, 4000);
}
var cont=1;
$(document).ready(function(){
    $('.addToCart').click(function() {
        window.$_GET = new URLSearchParams(location.search);
        var activeColor = $(".colorName").text();
        var activeSize = $("input[name='size']:checked").val();
        var activeSizeQty =$("input[name='size']:checked").attr('id').split(" ");
        var Qty = parseInt(activeSizeQty[1]);
        var idProd = $_GET.get('productId');
        var idCat = $_GET.get('categoryId');
        var data;
        console.log(Qty);
        if(Qty-cont==-1){
            showSnackBar("Taglia e colore scelto non disponibile")
        }
        else{
            data =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
            $.post(ajaxurl, data).done(function() {showSnackBar("Oggetto aggiunto correttamente al carrello")});
            addMessage(activeColor,activeSize);
            cont++;
        }
        $.ajax({
            type: "POST",
            url: '../php/order.php',
            data: data,
            success: function (){
                showSnackBar();
                addMessage(activeColor,activeSize);
            }
          });
        $.ajax({url: "../php/result.json", success: function(result){
            console.log(result);
            if(result > 0) {
                console.log(!$("a.cart").children().hasClass("badge"));
                if(!$("a.cart").children().hasClass("badge")) {
                    $("a.cart").append(`<span class="badge"></span>`);
                }
                if(!$("#messaggi span.icon_A_nav").children().hasClass("badge")) {
                    $("#messaggi span.icon_A_nav").append(`<span class="badge"></span>`);
                }
            }
        }});
    });
    $("article header ul li").click(function () {
        $("header > div").empty().append($(this).html());
    });
    $("button:first-of-type").click(function () {
        if($(".size").css("display") == "none") {
            $(".size").css("display", "block");
        } else {
            $(".size").css("display", "none");
        }
    });
    $("main > article > header > ul > li").click(function () {
        $(this).nextAll().removeClass("imageselected");
        $(this).prevAll().removeClass("imageselected");
        $(this).addClass("imageselected");
    });
    $(".size li").click(function () {
        if(!$(this).is(":first-of-type")) {
            $("button:first-of-type").text($(this).text());
        }
        $(".size").css("display", "none");
    });
});
