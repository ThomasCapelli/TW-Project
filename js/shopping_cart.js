function totalUpdate(){
    var tot = 0;
    $("table tr td:last-of-type").each(function(){
        if($(this).html()==''){
            tot = tot + parseFloat($(this).parent().find('[name="quantity"]').val()) * parseFloat($(this).parent().find('.price').html());
            $(this).html($(this).html()+" "+tot+"$");
            tot=0;
        }
        else{
            tot = tot + parseFloat($(this).html());
        }
    });
    if(document.getElementById("carro_buoi").checked){
        $(".sticky-bottom p").html("Totale:");
        tot = tot + 5;
        $(".sticky-bottom p").html($(".sticky-bottom p").html()+" "+tot+"$");
        tot=0;
    }
    if(document.getElementById("carro_cavalli").checked){
        $(".sticky-bottom p").html("Totale:");
        tot = tot + 20;
        $(".sticky-bottom p").html($(".sticky-bottom p").html()+" "+tot+"$");
        tot=0;
    }
}
function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    totalUpdate(); 
    wcqib_refresh_quantity_increments()

    $("main div div div input").click(totalUpdate);
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var par = this.parentElement;
    par = par.parentElement;
    par = par.parentElement.innerHTML;
    var priceStart = par.indexOf("price") + 7;
    var priceEnd = par.indexOf("$");
    var price = par.slice(priceStart,priceEnd);
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change");
    var sign = jQuery(this).is(".minus")? -1 : +1;
    var ajaxurl = "../php/buy.php";
    console.log(jQuery(this).parent().parent().parent().find(".remove_button").attr('name'));
    var idDO = jQuery(this).parent().parent().parent().find(".remove_button").attr('name');
    var data =  {'sign': sign, 'idDO': parseInt(idDO)};
    $.post(ajaxurl, data);
    if(b>=c && sign==+1){
        var tot = (b-1 + sign) * parseFloat(price);
    }
    else{
        var tot = (b + sign) * parseFloat(price);
    }
    if(a.val()==1){
        tot = parseFloat(price);
    }
    jQuery(this).parent().parent().parent().find("td:last-of-type").html(tot + "$");
    totalUpdate(); 

});
