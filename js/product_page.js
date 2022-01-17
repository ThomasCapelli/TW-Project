$(document).ready(function(){
    $('.addToCart').click(function() {
        window.$_GET = new URLSearchParams(location.search);
        var activeColor = $(".colorName").text();
        var activeSize = $("input[name='size']:checked").val();
        var idProd = $_GET.get('productId');
        var idCat = $_GET.get('categoryId');
        var ajaxurl = '../php/order.php';
        var data =  {'color': activeColor,'size': activeSize, 'idProdotto': parseInt(idProd), "idCategoria": parseInt(idCat)};
        $.post(ajaxurl, data);
    });
});
