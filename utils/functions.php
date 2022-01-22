<?php
    function calculatePrice($prezzo, $sconto){
        $price = $prezzo - ($prezzo * ($sconto / 100));
        return number_format($price, 2);
    }
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='selected' ";
        }
    }
    function registerLoggedUser($user){
        $_SESSION["email"] = $user["Email"];
        $_SESSION["nomeutente"] = $user["Email"]; 
    }
    function isUserLoggedIn(){
        return !empty($_SESSION["email"]);
    }
    function logOut(){
        if (isset($_SESSION["email"])) {
            unset($_SESSION["email"]);
            unset($_SESSION["nomeutente"]);
            unset($_SESSION["sessionCartToken"]);
        } 
    }
?>