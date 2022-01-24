<?php 
    require '../php/bootstrap.php';

    function checkQuantity(){
        require '../php/bootstrap.php';
        $templateParams["cartTemp"] = $dbh->getOrderDetails($_SESSION["nomeutente"]);
        foreach($templateParams["cartTemp"] as $prod){
            $templateParams["quantity"]=$dbh->getQuantity($prod["IdProdotto"],$prod["IdCategoria"],$prod["Taglia"],$prod["Colore"]);
            if($templateParams["quantity"][0]["Quantita"] < $prod["Quantita"]){
                $ris=1;
                return $ris;
            }
        }
        $ris=0;
        return $ris;
    }
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    if(isset($_POST["sign"])&&isset($_POST["idDO"])){
        $dbh->updateODQty($_POST["sign"],$_SESSION["nomeutente"],$_POST["idDO"]);
    }
    if(isset($_POST["remove"]) && isset($_POST["idDettaglioOrdine"])){
        $dbh->removeFromCart($_POST["idDettaglioOrdine"]);
    }
    if(isset($_POST["cartStatus"]) && $_POST["cartStatus"]==true && isset($_POST["total"])){
        $templateParams["cart"] = $dbh->getOrderDetails($_SESSION["nomeutente"]);
        $ris=checkQuantity();
        if($ris==1){
            $text="Quantità scelta superiore alla disponibilità";
            echo var_dump($text);
            $dbh->setNotifica($text,$_SESSION["nomeutente"]);
        }
        else{
            foreach($templateParams["cart"] as $prodotto){
                $dbh->updateProductQuantity($prodotto["IdDettaglioOrdine"]);
            }
            $dbh->clearCart();
            $_POST["cartStatus"]=false;
            $dbh->updateOrder($_SESSION["nomeutente"],$_POST["total"],$_SESSION["sessionCartToken"]);
            $_SESSION["sessionCartToken"]=rand(0,700);
        }
    }
?>