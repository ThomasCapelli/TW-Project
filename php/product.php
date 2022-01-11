<?php
    require_once '../php/bootstrap.php';

    //Base Template
    
    $templateParams["titolo"] = "NewEvo - Shop";
    $templateParams["prod"] = "../template/prodotto.php";
    $templateParams["nome"] = "../template/products.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js");
    $idcategoria = -1;
    if(isset($_GET["categoryName"])){
        $NomeCategoria = $_GET["categoryName"];
        if($NomeCategoria == "Saldi") {
            $templateParams["prodotti"] = $dbh->getSales();
        }
        elseif($NomeCategoria == "All") {
            $templateParams["prodotti"] = $dbh->getProducts();
        }
        else {
            $templateParams["prodotti"] = $dbh->getProductsByCategory($NomeCategoria);
        }
    }
    $templateParams["categoria"] = $NomeCategoria;
    
    require '../template/base.php';
?>