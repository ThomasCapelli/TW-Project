<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo - Home";
    $templateParams["nome"] = "../template/home.php";
    $templateParams["prod"] = "prodotto.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js");
    $templateParams["prodotti"] = $dbh->getSales(6);
    $templateParams["bestseller"] = $dbh->getBestSellers(5);
    $templateParams["imagesBest"] = array();
    $templateParams["images"] = array();
    foreach($templateParams["bestseller"] as $prodotto) {
        $idprodotto = $prodotto["IdProdotto"];
        $idcategoria = $prodotto["IdCategoria"];
        $color =  $dbh->getFirstOption($idprodotto, $idcategoria);
        array_push($templateParams["imagesBest"], $dbh->getImage($idprodotto, $idcategoria, $color[0]["Colore"]));
    }
    foreach($templateParams["prodotti"] as $prodotto) {
        $idprodotto = $prodotto["IdProdotto"];
        $idcategoria = $prodotto["IdCategoria"];
        $color =  $dbh->getFirstOption($idprodotto, $idcategoria);
        array_push($templateParams["images"], $dbh->getImage($idprodotto, $idcategoria, $color[0]["Colore"]));
    }
    require '../template/base.php';
?>