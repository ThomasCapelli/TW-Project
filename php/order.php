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
        $templateParams["carrello"]=$dbh->getCarrello($_SESSION["nomeutente"]);
        $flag=1;
        foreach($templateParams["carrello"] as $elementoCart){
            if($elementoCart["IdProdotto"]==$_POST["idProdotto"] && $elementoCart["IdCategoria"]==$_POST["idCategoria"] && $elementoCart["Taglia"]==$_POST["size"] && $elementoCart["Colore"]== $_POST["color"]){
                $dbh->updateQuantity($_POST["idProdotto"],$_POST["idCategoria"],$elementoCart["IdDettaglioOrdine"]);
                $flag=0;
            }
        }
        if($flag==1){
            $templateParams["prodotto"]=$dbh->getProductById($_POST["idProdotto"], $_POST["idCategoria"]);
            $prodotto=$templateParams["prodotto"][0];
            $dbh->placeOrder($_POST["idCategoria"], $prodotto["IdProduttore"], $_POST["idProdotto"],$idDettaglioOrdine,$quantita, $_POST["size"], $_POST["color"], $_SESSION["nomeutente"], $_SESSION["sessionCartToken"]);     
        }   
    }
?>