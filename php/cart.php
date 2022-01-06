<?php
    require_once '../php/bootstrap.php';

    $templateParams["titolo"] = "NewEvo - Cart";
    $templateParams["ordini"] = $dbh->getCarrello();
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/shopping_cart.js");
    require '../template/shopping_cart.php';
    
?>