<?php
    require_once '../php/bootstrap.php';
    require_once '../php/order.php';

    $productImages = array();
    $templateParams["titolo"] = "NewEvo - Cart";
    $templateParams["nome"] = "../template/shopping_cart.php";
    $templateParams["ordini"] = $dbh->getCarrello($_SESSION["nomeutente"]);
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/account_nav.js", "../js/menu.js", "../js/shopping_cart.js", "../js/dark-mode.js", "../js/header.js","../js/buy.js");
    require '../template/base.php';
    
?>