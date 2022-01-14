$(document).ready(function(){
    var total = $(".sticky-bottom p").text();
    console.log(total);
    total = total.replace("$","");
    total = parseFloat(total);
    console.log(total);
    $('.button-buy').click(function() {
        var address=$("footer div div:first-of-type input").val();
        console.log(address)
        if($("input[name='spedizione']").is(":checked") &&  $("input[name='pagamento']").is(":checked") && address!=""){
            var ajaxurl = '../php/buy.php';
            var cartStatus = true;
            var total = $(".sticky-bottom p").text();
            total = total.replace("$","");
            total = total.replace("Totale: ","");
            console.log(total);
            total = parseFloat(total);
            console.log(total);
            var data =  {'cartStatus': cartStatus, 'total': total};
            $.post(ajaxurl, data);
        }  
    });
});