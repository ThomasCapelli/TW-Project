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
var flag=0;
$(document).ready(function(){
    $('.addToCart').click(function() {
        window.$_GET = new URLSearchParams(location.search);
        if(flag==1){
            var activeColor = $(".colorName").text();
            var size = $(".tagliaButton").text().trim().split(" ");
            var activeSize = size[0];
            var activeSizeQty = parseInt(size[3]);
            var idProd = $_GET.get('productId');
            var idCat = $_GET.get('categoryId');
            var data;
            var ajaxurl = '../php/order.php';
            if(activeSizeQty==0){
                showSnackBar("Taglia e colore scelto non disponibile");
            }
            else{
                data =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
                $.post(ajaxurl, data).done(function() {showSnackBar("Oggetto aggiunto correttamente al carrello")});
                addMessage(activeColor,activeSize);
                size[3]=activeSizeQty-1;
                $(".tagliaButton").text(size.join().replace(/,/g," "));
                flag=0;
            }
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
        }
        else{
            showSnackBar("Taglia non scelta");
        }
    });
    $("article header ul li").click(function () {
        $("article header > div").empty().append($(this).html());
    });
    $("article button:first-of-type").click(function () {
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
            $(".tagliaButton").text($(this).text());
        }
        flag=1;
        $(".size").css("display", "none");
    });
});
