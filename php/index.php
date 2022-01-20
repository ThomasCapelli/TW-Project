<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo - Home";
    $templateParams["nome"] = "../template/home.php";
    $templateParams["prod"] = "prodotto.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/notification.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js");
    $templateParams["prodotti"] = $dbh->getSales(6);
    $templateParams["bestseller"] = $dbh->getBestSellers(5);

    require '../template/base.php';
?>