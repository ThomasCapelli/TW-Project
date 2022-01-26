<?php
require_once("../php/bootstrap.php");
if(isset($_FILES["imgprodotto"])) {
    list($result, $img) = uploadImage(UPLOAD_DIR, $_FILES["imgprodotto"]);
}
if(isset($_POST["nomeprodotto"]) 
    && isset($_POST["descrizione"]) 
    && isset($_POST["descrizione_breve"]) 
    && isset($_POST["categoria"])
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
        $dbh->newImgOpzione($img, $_POST["categoria"], $_POST["produttore"], $idprodotto, $_POST["colore"]);
        $dbh->newTaglia($_POST["taglia"], $_POST["quantita"], $_POST["categoria"], $_POST["produttore"], $idprodotto, $_POST["colore"]); 
        if($result) {
            $msg = "Inserimento andato a buon fine!";
        } else {
            $msg = "Inserimento errato, ricontrollare i valore inseriti";
        }
    }
header("location: admin.php?formmsg=".$msg);
?>