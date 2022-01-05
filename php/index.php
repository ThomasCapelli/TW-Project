<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo - Home";
    $templateParams["nome"] = "../template/home.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/mobile_viewer_fix.js", "../js/account_nav.js");
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["scontati"] = $dbh->getSales(6);
    $templateParams["bestseller"] = $dbh->getBestSellers();

    require '../template/base.php';
?>