<?php
    session_start();
    define("UPLOAD_DIR", "../icons/");
    require_once("../db/database.php");
    require_once("../utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "e_commerce", 3306);
    $templateParams["webtitle"] = "NewEvo";
    $templateParams["categorie"] = $dbh->getCategories();
    if(isUserLoggedIn()) {
        if(!isset($_SESSION["sessionCartToken"])){
            $_SESSION["sessionCartToken"]=rand(0,700);
        }
    }
    if(isUserLoggedIn()) {
        $mode = $dbh->getMode($_SESSION["email"]);
        if($mode[0]["DarkMode"] == 0) {
            $templateParams["mode"] = "light_mode";
        } else {
            $templateParams["mode"] = "dark_mode";
        }
    } else {
        $templateParams["mode"] = "light_mode";
    }
    if(isset($_SESSION["sessionCartToken"])){
        $templateParams["storico"] = $dbh->getOrders($_SESSION["nomeutente"]);
        $templateParams["ordini"] = $dbh->getCarrello($_SESSION["nomeutente"]);
    }
    if(isUserLoggedIn()) {
        $templateParams["profilo"]=$dbh->getUtente($_SESSION["nomeutente"]);
        $templateParams["utente"] = $dbh->getName($_SESSION["email"]);
        $templateParams["notifiche"] = $dbh->getNotifiche($_SESSION["email"]);
        $templateParams["admin"]=$dbh->isAdmin($_SESSION["nomeutente"]);
        if($templateParams["admin"][0]["Admin"]==1){
            if(!isset( $_SESSION["admin"])){
                $_SESSION["admin"]=1;
                $templateParams["notificaQty"]=$dbh->getQtyZero();
                foreach($templateParams["notificaQty"] as $notifica){
                    $text="Esaurito: ".$notifica["NomeProdotto"]." Taglia: ".$notifica["Nome_taglia"]." Colore: ".$notifica["Colore"];
                    $dbh->setNotifica($text,$_SESSION["nomeutente"]);
                }
            }
        }
        $templateParams["numero"] = 0;
        foreach($templateParams["notifiche"] as $notifica) {
            if($notifica["Letta"] == "no") {
                $templateParams["numero"] = $templateParams["numero"] + 1;
            }
        }
        if(isset($_SESSION["sessionCartToken"])){
            $templateParams["storico"] = $dbh->getOrders($_SESSION["nomeutente"]);
            $templateParams["ordini"] = $dbh->getCarrello($_SESSION["nomeutente"]);
        }
    } else {
        $templateParams["mode"] = "light_mode";
    }
?>