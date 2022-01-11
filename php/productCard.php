<?php
    require_once '../php/bootstrap.php';

    //Base Template
    
    $templateParams["titolo"] = "NewEvo - Prodotto";
    
    $templateParams["nome"] = "../template/single-product.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/products.js");
    if(isset($_GET["productId"]) && isset($_GET["categoryId"])) {
        $idprodotto = $_GET["productId"];
        $idcategoria = $_GET["categoryId"]; 
        $templateParams["prodotto"] = $dbh->getProductById($idprodotto, $idcategoria);
        $templateParams["opzioni"] = $dbh->getOpzioni($idprodotto, $idcategoria);
        $templateParams["taglie"] =  $dbh->getSize($idprodotto, $idcategoria, $templateParams["opzioni"][0]["Colore"]); 
    }
    
    require '../template/base.php';
?>