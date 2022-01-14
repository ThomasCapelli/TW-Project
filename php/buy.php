<?php 
    require_once '../php/bootstrap.php';
    if(isset($_POST["cartStatus"]) && $_POST["cartStatus"]==true && isset($_POST["total"])){
        $dbh->clearCart();
        $_POST["cartStatus"]=false;
        $dbh->updateOrder($_SESSION["nomeutente"],$_POST["total"],$_SESSION["sessionCartToken"]);
        $_SESSION["sessionCartToken"]=rand(0,700);
    }
?>