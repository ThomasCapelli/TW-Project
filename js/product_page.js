function addBadge() {
    $("a.account").append(`<span class="badge"></span>`);
    $("#messaggi a span:first-of-type").append(`<span class="badge"></span>`);
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
function getDate() {
    var d = new Date();
    var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
    return strDate;
}
function setNotifica($testo, $size, $color) {
    let date = getDate();
    $.ajax({
        method: "POST",
        url: '../php/notify.php',
        data: {notifica: $testo, date: date},
        success: function (){
            addMessage($size, $color, date);
        }
    });
}
var cont=1;
$(document).ready(function(){
    $('.addToCart').click(function() {
        window.$_GET = new URLSearchParams(location.search);
        var activeColor = $(".colorName").text();
        var activeSize = $("input[name='size']:checked").val();
        console.log(activeSize);
        var activeSizeQty =$("input[name='size']:checked").attr('id').split(" ");
        var Qty = parseInt(activeSizeQty[1]);
        var idProd = $_GET.get('productId');
        var idCat = $_GET.get('categoryId');
        var dati;
        let testo;
        if(Qty-cont==-1){
            showSnackBar("Taglia e colore scelto non disponibile")
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
            $("button:first-of-type").text($(this).text());
        }
        $(this).children().last().attr("checked", "checked");
        $(".size").css("display", "none");
    });
});
