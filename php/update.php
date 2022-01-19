<?php
if(isUserLoggedIn()) {
    $templateParams["cart"] = $dbh->getCarrello($_SESSION["nomeutente"]);
    $tot = 0;
    foreach($templateParams["cart"] as $element) {
        $tot = $tot + $element["Quantita"];
    }
    $templateParams["cartnumber"] = $tot;
}
?>