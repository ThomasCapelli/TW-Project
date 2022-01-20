function addPaypal(){
    if($('#paypal').is(":checked")){
        $(".footer div div:last-of-type").show(); 
    }
    else{
        $(".footer div div:last-of-type").css("display","none");
    }
}
function reload() {
    $("body").load("../php/cart.php").fadeIn("slow");
}
$(document).ready(function(){
    $(".footer div div:last-of-type").css("display","none");
    $('.button-buy').click(function() {
        var address=$(".footer div div:first-of-type input").val();
        if($(".footer div div:last-of-type").css("display")=="none"){
            if($("input[name='spedizione']").is(":checked") &&  $("input[name='pagamento']").is(":checked") && address!=""){
                var ajaxurl = '../php/buy.php';
                var cartStatus = true;
                var total = $(".sticky-bottom p").text();
                total = total.replace("$","");
                total = total.replace("Totale: ","");
                total = parseFloat(total);
                var data =  {'cartStatus': cartStatus, 'total': total};
                $.post(ajaxurl, data);
                location.href="../php/index.php";
            }
            else{
                var ajaxurl = '../php/buy.php';
                var data =  {'erroreInserimento': "Errore nell'inserimento di pagamento e spedizione"};
                $.post(ajaxurl, data);
            }  
        }
        else{
            var email=$('#emailPaypal').val();
            var password=$('#passwordPaypal').val();
            if($("input[name='spedizione']").is(":checked") &&  $("input[name='pagamento']").is(":checked") && address!="" && email!="" && password!=""){
                var ajaxurl = '../php/buy.php';
                var cartStatus = true;
                var total = $(".sticky-bottom p").text();
                total = total.replace("$","");
                total = total.replace("Totale: ","");
                total = parseFloat(total);
                var data =  {'cartStatus': cartStatus, 'total': total};
                $.post(ajaxurl, data);
                location.href="../php/index.php";
            }
            else{
                var ajaxurl = '../php/buy.php';
                var data =  {'erroreInserimento': "Errore nell'inserimento di pagamento e spedizione"};
                $.post(ajaxurl, data);
            }  
        }
       
    });
    $('#paypal').change(addPaypal);
    $("input[name='pagamento']").change(addPaypal);
    
    $(".remove_button").click(function(){
        var idDO = $(this).attr("name");
        var ajaxurl = '../php/buy.php';
        var data =  {'remove': 1 , 'idDettaglioOrdine': parseInt(idDO)};
        $.post(ajaxurl, data);
        success: reload();
    });
});