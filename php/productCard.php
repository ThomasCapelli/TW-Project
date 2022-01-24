<?php
    require '../php/bootstrap.php';

    //Base Template
    
    $templateParams["titolo"] = "NewEvo - Prodotto";
    
    $templateParams["nome"] = "../template/single-product.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/menu.js", "../js/header.js", "../js/product_page.js");
    if(isset($_GET["productId"]) && isset($_GET["categoryId"])) {
        $idprodotto = $_GET["productId"];
        $idcategoria = $_GET["categoryId"]; 
        $templateParams["prodotto"] = $dbh->getProductById($idprodotto, $idcategoria);
        $templateParams["opzioni"] = $dbh->getOpzioni($idprodotto, $idcategoria);
        $templateParams["imgopzione"] = array();
        foreach($templateParams["opzioni"] as $opzione) {
            $img = $dbh->getImages($idprodotto, $idcategoria, $opzione["Colore"]);
            array_push($templateParams["imgopzione"], $img[0]["URL"]);
        }
    }
    if(isset($_GET["colore"])) {
        $templateParams["maincolor"] = array(array("Colore" => $_GET["colore"]));
    } else {
        $templateParams["maincolor"] = $dbh->getFirstOption($idprodotto, $idcategoria);
    }
    $templateParams["taglie"] =  $dbh->getSize($idprodotto, $idcategoria, $templateParams["maincolor"][0]["Colore"]); 
    $templateParams["images"] = $dbh->getImages($idprodotto, $idcategoria, $templateParams["maincolor"][0]["Colore"]);
    require '../template/base.php';
?>