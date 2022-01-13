<?php
    session_start();
    define("UPLOAD_DIR", "../icons/");
    require_once("../db/database.php");
    require_once("../utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "e_commerce", 3306);
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