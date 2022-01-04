<?php
    function calculatePrice($prezzo, $sconto){
        return $prezzo - ($prezzo * ($sconto / 100));
    }
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='selected' ";
        }
    }
    function registerLoggedUser($user){
        $_SESSION["email"] = $user["Email"];
        $_SESSION["nomeutente"] = $user["Nome"]; 
    }
    function isUserLoggedIn(){
        return !empty($_SESSION["email"]);
    }

?>