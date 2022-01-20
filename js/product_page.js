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
$(document).ready(function(){
    $('.addToCart').click(function() {
        window.$_GET = new URLSearchParams(location.search);
        var activeColor = $(".colorName").text();
        var activeSize = $("input[name='size']:checked").val();
        var idProd = $_GET.get('productId');
        var idCat = $_GET.get('categoryId');
        var ajaxurl = '../php/order.php';
        var data;
        console.log(activeSize);
        console.log(activeColor);
        if(activeSize==null){
            console.log("YO");
            if(activeColor==''){
                console.log("FRA");
                data =  {'color': "default",'size': "def", 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
            }
            else{
                data =  {'color': activeColor,'size': "def", 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
            }
        }
        else{
            data =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
        }
        $.post(ajaxurl, data).done(function() {showSnackBar()});
        addMessage(activeColor,activeSize);
    });
});
