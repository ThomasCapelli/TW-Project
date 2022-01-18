<?php
    session_start();
    define("UPLOAD_DIR", "../icons/");
    require_once("../db/database.php");
    require_once("../utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "e_commerce", 8111);
    $templateParams["webtitle"] = "NewEvo";
    $templateParams["categorie"] = $dbh->getCategories();
    if(isset($_POST["mode"])) {
        if($_POST["mode"] == "dark") {
            $dbh->changeMode(1, $_SESSION["email"]);
        }
        else {
            $dbh->changeMode(0, $_SESSION["email"]);
        }
    }
    if(isUserLoggedIn()) {
        if(!isset($_SESSION["sessionCartToken"])){
            $_SESSION["sessionCartToken"]=rand(0,700);
            $templateParams["cartnumber"] = count($dbh->getCarrello($_SESSION["nomeutente"]));
        }
        $mode = $dbh->getMode($_SESSION["email"]);
        if($mode[0]["DarkMode"] == 0) {
            $templateParams["mode"] = "light_mode";
        } else {
            $templateParams["mode"] = "dark_mode";
        }

    } else {
        $templateParams["mode"] = "light_mode";
    }
?>