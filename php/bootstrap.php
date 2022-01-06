<?php
    session_start();
    define("UPLOAD_DIR", "../icons/");
    require_once("../db/database.php");
    require_once("../utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "e_commerce", 3306);
    $templateParams["webtitle"] = "NewEvo";
    $templateParams["categorie"] = $dbh->getCategories();
?>