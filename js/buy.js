$(document).ready(function(){
    $('.button-buy').click(function() {
        var address=$("footer div div:first-of-type input").val();
        console.log(address)
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
});