<?php
require_once 'bootstrap.php';
$templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/form.js", "../js/menu.js");
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Username o password errati!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    header("Location:"."index.php");
}
else{
    $templateParams["titolo"] = "NewEvo - Login";
    $templateParams["nome"] = "../template/login-form.php";
}
require '../template/base.php';
?>