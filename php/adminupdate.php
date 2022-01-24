<?php
    require_once '../php/bootstrap.php';;

    //Base Template
    $templateParams["titolo"] = "NewEvo -AdminDelete";
    $templateParams["nome"] = "../template/admin-update.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js", "../js/form.js");
    $templateParams["prodotti"] = $dbh->getProducts();
    $templateParams["images"] = array();
    $templateParams["color"] = array();
    foreach($templateParams["prodotti"] as $key=>$prodotto) {
        $idprodotto = $prodotto["IdProdotto"];
        $idcategoria = $prodotto["IdCategoria"];
        $color =  $dbh->getFirstOption($idprodotto, $idcategoria);
        array_push($templateParams["color"],  $color[0]["Colore"]);
        array_push($templateParams["images"], $dbh->getImage($idprodotto, $idcategoria, $color[0]["Colore"]));
    }
    if(isset($_POST["opzione"]) && isset($_POST["categoria"]) && isset($_POST["idprodotto"]) ) {
        
    }
    require '../template/base.php';
?>