<?php
    require_once '../php/bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "NewEvo -AdminForm";
    $templateParams["nome"] = "../template/admin-form.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js","../js/menu.js", "../js/carousel.js", "../js/sticky-nav.js", "../js/dark-mode.js", "../js/account_nav.js", "../js/header.js", "../js/form.js");
    $templateParams["produttori"] = $dbh->getProducers();
    if(isset($_GET["formmsg"])) {
        $templateParams["erroreInserimento"] = $_GET["formmsg"];
    }
    if(isset($_POST["nomeprodotto"]) 
    && isset($_POST["descrizione"]) 
    && isset($_POST["descrizione_breve"]) 
    && isset($_POST["categoria"]) 
    && isset($_POST["imgprodotto"])
    && isset($_POST["prezzo"])
    && isset($_POST["sconto"])
    && isset($_POST["colore"])
    && isset($_POST["taglia"]) 
    && isset($_POST["quantita"])
    && isset($_POST["produttore"])) {
        $idprodotto = $dbh->getLastId($_POST["categoria"]);
        if(count($idprodotto) == 0) {
            $idprodotto[0]["IdProdotto"] = 0;
        }
        $idprodotto = intval($idprodotto[0]["IdProdotto"]) + 1;
        $result = $dbh->newProduct($idprodotto, $_POST["categoria"], $_POST["produttore"], $_POST["nomeprodotto"], $_POST["prezzo"], $_POST["descrizione"], $_POST["descrizione_breve"], $_POST["sconto"]);
        $dbh->newColor($_POST["categoria"], $_POST["produttore"], $idprodotto, $_POST["colore"]);
        $dbh->newImgOpzione($_POST["imgprodotto"], $_POST["categoria"], $_POST["produttore"], $idprodotto, $_POST["colore"]);
        $dbh->newTaglia($_POST["taglia"], $_POST["quantita"], $_POST["categoria"], $_POST["produttore"], $idprodotto, $_POST["colore"]); 
        if($result) {
            $msg = "Inserimento andato a buon fine!";
            header("location: admin.php?formmsg=".$msg);
        } else {
            $templateParams["erroreInserimento"] = "Inserimento errato, ricontrollare i valore inseriti";
        }
    }
    require '../template/base.php';
?>