
<?php
    require_once '../php/bootstrap.php';
    if(isUserLoggedIn() && isset($_POST["date"]) && isset($_POST["notifica"])) {
        $dbh->setNotifica($_POST["notifica"], $_POST["date"], $_SESSION["email"]);
    }
    if(isset($_POST["letta"])) {
        $dbh->setLette($_SESSION["email"]);
    }
    if(isset($_POST["changeOrderStatus"]) && isset($_POST["idO"])){
        $dbh->changeOrderStatus($_POST["idO"],$_SESSION["nomeutente"]);
        $dbh->setOrderNotification($_POST["idO"],$_SESSION["nomeutente"]);
    }
?>