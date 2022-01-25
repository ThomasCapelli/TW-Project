
function showSnackBar(testo) {
    $("div.snackbar").css("display","initial");
    $("div.snackbar").text(testo);
    window.setInterval(function() {
        $("div.snackbar").hide();
    }, 4000);
}
$(document).ready(function(){
    $(".update").click(function(){
        var currentRow=$(this).closest("tr"); 
        var idProd=currentRow.find("td:eq(0)").attr('id'); 
        console.log(idProd);
        var idCat=currentRow.find("td:eq(1)").attr('id');
        console.log(idCat);
        var color=currentRow.find("td:eq(2)").text();
        console.log(color);
        var size=currentRow.find("td:eq(3)").text();
        console.log(size);
        var ajaxurl="../php/admin_update_func.php";
        var data =  {'idP': parseInt(idProd), 'idC': parseInt(idCat), 'color': color, 'size': size};
        $.post(ajaxurl, data);
        showSnackBar("Quantità prodotto aumentata +1");
        setTimeout(function(){
            window.location.reload(1);
        }, 4000);
    });
});