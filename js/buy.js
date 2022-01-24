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
function showSnackBar(testo) {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text(testo);
    window.setInterval(function() {
        $("div.snackbar").hide();
    }, 4000);
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
                reload();
                showSnackBar("Ordine in elaborazione");
            }
            else{
                showSnackBar("Errore nell'inserimento della spedizione o pagamento");
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
                reload();
                showSnackBar("Ordine in elaborazione");
            }
            else{
                showSnackBar("Errore nell'inserimento della spedizione o pagamento");
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