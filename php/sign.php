<?php
    require_once '../php/bootstrap.php';
    $templateParams["titolo"] = "NewEvo - SignUp";
    $templateParams["js"] = array("../js/jquery-3.4.1.min.js", "../js/dark-mode.js", "../js/signUp.js", "../js/menu.js");
    if(isset($_POST["email"])){
        $email_result = $dbh->validateEmail($_POST["email"]);
        if(count($email_result) != 0){
            $templateParams["erroreEmail"] = "Errore, Email già utilizzata, inserirne una valida";
        }
        else {
            if(isset($_POST["email"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["data"]) && isset($_POST["password"]) && isset($_POST["indirizzo"])) {
                $signup_result = $dbh->signUp($_POST["email"], $_POST["nome"], $_POST["cognome"], $_POST["data"], $_POST["password"], $_POST["indirizzo"]);
                if($signup_result) {
                    header("Location:"."login.php");
                } else {
                    $templateParams["erroreEmail"] = "Errore nella registrazione";
                }
            }
        }
    }
    $templateParams["nome"] = "../template/signUp-form.php";
    require '../template/base.php';
?>