<?php
    require_once 'bootstrap.php';
    logOut();
    if(!isUserLoggedIn()){
        header("Location:"."index.php");
    }
?>