$(document).ready(function(){
    $('.button-buy').click(function() {
        var address=$("footer div div:first-of-type input").val();
        if($("input[name='spedizione']").is(":checked") &&  $("input[name='pagamento']").is(":checked") && address!=""){
            var ajaxurl = '../php/buy.php';
            var cartStatus = true;
            var total = $(".sticky-bottom p").text();
            total = total.replace("$","");
            total = total.replace("Totale: ","");
            total = parseFloat(total);
            var data =  {'cartStatus': cartStatus, 'total': total};
            $.post(ajaxurl, data);
        }  
    });
    $(".remove_button").click(function(){
        var idDO = $(this).attr("name");
        var ajaxurl = '../php/buy.php';
        var data =  {'remove': 1 , 'idDettaglioOrdine': parseInt(idDO)};
        $.post(ajaxurl, data);
        success: reload();
    });
    function reload() {
        $("body").load("../php/cart.php").fadeIn("slow");
    }

});