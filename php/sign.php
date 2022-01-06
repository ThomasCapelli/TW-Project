<?php
    require_once '../php/bootstrap.php';
    
    /*if(isset($_POST["username"]) && isset($_POST["password"])){
        $signup_result = $dbh->SignUp($_POST["username"], $_POST["password"]);
        if(){
            //Login fallito
            $templateParams["errorelogin"] = "Errore! Controllare username o password!";
        }
        else{
            registerLoggedUser($login_result[0]);
        }
    }*/
    $templateParams["titolo"] = "NewEvo - SignUp";
    $templateParams["nome"] = "../template/signUp-form.php";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/dark-mode.js", "../js/signUp.js");
    $templateParams["scontati"] = $dbh->getSales();

    require '../template/base.php';
?>