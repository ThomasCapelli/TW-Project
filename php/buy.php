<?php 
    require_once '../php/bootstrap.php';
    if(isset($_POST["remove"]) && isset($_POST["idDettaglioOrdine"])){
        $dbh->removeFromCart($_POST["idDettaglioOrdine"]);
    }
    if(isset($_POST["cartStatus"]) && $_POST["cartStatus"]==true && isset($_POST["total"])){
        $templateParams["cart"] = $dbh->getOrderDetails($_SESSION["nomeutente"]);
        foreach($templateParams["cart"] as $prodotto){
            $dbh->updateProductQuantity($prodotto["IdDettaglioOrdine"]);
        }
        $dbh->clearCart();
        $_POST["cartStatus"]=false;
        $dbh->updateOrder($_SESSION["nomeutente"],$_POST["total"],$_SESSION["sessionCartToken"]);
        $_SESSION["sessionCartToken"]=rand(0,700);
        require '../template/base.php';
    }
?>