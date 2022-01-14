<?php
    require_once '../php/bootstrap.php';
    require_once '../php/cart.php';
    
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
  
    if(isset($_POST["color"]) && isset($_POST["size"])) {
        $idDettaglioOrdine = rand(0,500);
        $quantita = 1;
        $templateParams["ordine"]=$dbh->getOrder($_SESSION["nomeutente"]);
        if(!isset($templateParams["ordine"][0]["IdOrdine"])){
            $dbh->setOrder($_SESSION["nomeutente"],$_SESSION["sessionCartToken"]);
        }
        else{
            $_SESSION["sessionCartToken"]=$templateParams["ordine"][0]["IdOrdine"];
        }
        $dbh->placeOrder($_POST["idCategoria"],$_POST["idProduttore"],$_POST["idProdotto"],$idDettaglioOrdine,$quantita, $_POST["size"], $_POST["color"], $_SESSION["nomeutente"],$_SESSION["sessionCartToken"]);
    }         
?>