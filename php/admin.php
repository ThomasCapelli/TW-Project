<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo - Notifiche";
    $templateParams["nome"] = "../template/admin-form.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js", "../js/form.js");
    $templateParams["produttori"] = $dbh->getProducers();
    require '../template/base.php';
?>