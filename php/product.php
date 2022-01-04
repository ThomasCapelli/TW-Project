<?php
    require_once '../php/bootstrap.php';

    //Base Template
    
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo"] = "NewEvo - Shop";
    $templateParams["nome"] = "../template/products.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js");
    $idcategoria = -1;
    if(isset($_GET["categoryid"])){
        $idcategoria = $_GET["categoryid"];
    }
    $templateParams["categoria"] = $dbh->getCategoryById($idcategoria);
    $templateParams["prodotti"] = $dbh->getProductsByCategory($idcategoria);
    require '../template/base.php';
?>