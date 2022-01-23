<?php
    require_once '../php/bootstrap.php';

    if(isset($_POST["changeOrderStatus"]) && isset($_POST["idO"])){
        $dbh->changeOrderStatus($_POST["idO"],$_SESSION["nomeutente"]);
        $dbh->setOrderNotification($_POST["idO"],$_SESSION["nomeutente"]);
    }
    
?>