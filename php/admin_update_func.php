<?php 
    require_once '../php/bootstrap.php';

    if(isset($_POST["idP"]) && isset($_POST["idC"]) && isset($_POST["color"]) && isset($_POST["size"])){
        $dbh->updateSizeQty($_POST["idP"],$_POST["idC"],$_POST["color"],$_POST["size"]);
    }
?>