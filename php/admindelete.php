<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo -AdminDelete";
    $templateParams["nome"] = "../template/admin-delete.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js", "../js/form.js");
    $templateParams["prodotti"] = $dbh->getProducts();
    $templateParams["images"] = array();
    $templateParams["color"] = array();
    if(isset($_GET["formmsg"])) {
        $templateParams["erroreAzione"] = $_GET["formmsg"];
    }
    if(isset($_GET["idprodotto"]) && isset($_GET["idcategoria"])) {
        $result = $dbh->deleteImg($_GET["idprodotto"], $_GET["idcategoria"]);
        $result1 = $dbh->deletetaglia($_GET["idprodotto"], $_GET["idcategoria"]);
        $result2 = $dbh->deleteOpzione($_GET["idprodotto"], $_GET["idcategoria"]);
        if($result && $result1 && $result2) {
            $result = $dbh->deleteProduct($_GET["idprodotto"], $_GET["idcategoria"]);
            if($result) {
                $msg = "Cancellato correttamente!";
                header("location: admindelete.php?formmsg=".$msg);
            } else {
                $templateParams["erroreAzione"] = "Cancellazione non andata a buon fine..";
            }
        } else {
            $templateParams["erroreAzione"] = "Cancellazione non andata a buon fine..";
        }
    }
    foreach($templateParams["prodotti"] as $prodotto) {
        $idprodotto = $prodotto["IdProdotto"];
        $idcategoria = $prodotto["IdCategoria"];
        $color =  $dbh->getFirstOption($idprodotto, $idcategoria);
        array_push($templateParams["color"],  $color[0]["Colore"]);
        array_push($templateParams["images"], $dbh->getImage($idprodotto, $idcategoria, $color[0]["Colore"]));
    }
    require '../template/base.php';
?>