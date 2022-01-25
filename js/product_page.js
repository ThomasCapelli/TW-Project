function checkBadge(current) {
    if(!current.children().last().hasClass("badge")) {
        current.append(`<span class="badge"></span>`);
    }
}
function addBadge() {
    checkBadge($("a.cart"));
    checkBadge($("a.account"));
    checkBadge( $("#messaggi a span:first-of-type"));
}
function addMessage(activeColor,activeSize, date) {
    $("<li class='new'>Hai aggiunto a carrello: "+$(".productName").text()+" Taglia: "+activeSize+" Colore: "+activeColor+"<br/>"+date+"</li>").insertAfter("ul.notify li:first-of-type");
    addBadge();
}
function showSnackBar(testo) {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text(testo);
    window.setInterval(function() {
        $("div.snackbar").hide();
    }, 4000);
}
function setNotifica($testo, $size, $color) {
    $.ajax({
        method: "POST",
        url: '../php/notify.php',
        data: {notifica: $testo},
        success: function (){
            addMessage($size, $color);
        }
    });
}
var cont=1;
var flag=0;
$(document).ready(function(){
    $('.addToCart').click(function() {
        var textString="Accedi per poter comprare";
        if($('.addToCart').text().trim()==textString.trim()){
            showSnackBar("Accedi per poter comprare");
        }
        else{
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
                    testo = "Hai aggiunto a carrello: "+$(".productName").text()+" Taglia: "+activeSize+" Colore: "+activeColor+"";
                    dati =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
                    $.ajax({
                        method: "POST",
                        url: '../php/order.php',
                        data: {color: activeColor, size: activeSize, idProdotto: parseInt(idProd), idCategoria: parseInt(idCat)},
                        success: function (){
                            showSnackBar("Oggetto aggiunto correttamente al carrello");
                            cont++;
                            setNotifica(testo, activeSize, activeColor);
                        }
                    });
                    size[3]=activeSizeQty-1;
                    $(".tagliaButton").text(size.join().replace(/,/g," "));
            }
        } else{
            showSnackBar("Taglia non scelta");
        }
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
            console.log($(this).text());
            $(".tagliaButton").text($(this).text());
            $(this).children().last().attr("checked", "checked");
            flag=1;
        }
        $(".size").css("display", "none");
    });
});
