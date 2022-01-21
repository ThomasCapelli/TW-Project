function addMessage(activeColor,activeSize) {
    var list = $('ul.notify');
        $("<li class='new'>Hai aggiunto a carrello: "+$(".productName").text()+" Taglia:"+activeSize+" Colore:"+activeColor+"</li>").insertAfter("ul.notify li:first-of-type");
}
function showSnackBar() {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text("Oggetto aggiunto correttamente al carrello");
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
        var ajaxurl = '../php/order.php';
        var data;
        console.log(Qty);
        if(Qty-cont==-1){
            console.log("errore");
        }
        else{
            data =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
            $.post(ajaxurl, data).done(function() {showSnackBar()});
            addMessage(activeColor,activeSize);
            cont++;
        }
    });
});
