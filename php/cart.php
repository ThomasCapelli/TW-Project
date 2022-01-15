<?php
    require_once '../php/bootstrap.php';

    $templateParams["titolo"] = "NewEvo - Cart";
    $templateParams["nome"] = "../template/shopping_cart.php";
    $templateParams["ordini"] = $dbh->getCarrello();
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/account_nav.js", "../js/menu.js", "../js/shopping_cart.js", "../js/dark-mode.js", "../js/header.js");
    require '../template/base.php';
    
?>