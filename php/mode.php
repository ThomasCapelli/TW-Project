<?php
    require_once '../php/bootstrap.php';
    if(isset($_POST["mode"])) {
        if($_POST["mode"] == "dark") {
            $dbh->changeMode(1, $_SESSION["email"]);
        }
        else {
            $dbh->changeMode(0, $_SESSION["email"]);
        }
    }
?>
