<?php
    require_once '../php/bootstrap.php';
    $templateParams["titolo"] = "NewEvo - SignUp";
    $templateParams["nome"] = "../template/signUp.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/signUp.js");
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["scontati"] = $dbh->getSales();

    require '../template/base.php';
?>