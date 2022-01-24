<section>
    <h2>Elimina articoli</h2>
    <?php if(isset($templateParams["erroreAzione"])): ?>
                <p><?php echo $templateParams["erroreAzione"]; ?></p>
            <?php endif; ?>
    <table class="admintable">
        <tr>
            <th>NomeProdotto</th><th>Immagine</th><th>Colore</th><th>Azione</th>
            <?php foreach($templateParams["prodotti"] as $key=>$prodotto): ?>
            <tr>
                <td><?php echo $prodotto["NomeProdotto"];?></td>
                <td><img src="<?php echo UPLOAD_DIR.$templateParams["images"][$key][0]["URL"];?>" alt=""></td>
                <td><?php echo $templateParams["color"][$key]?></td>
                <td><a href="../php/admindelete.php?idprodotto=<?php echo $prodotto["IdProdotto"];?>&idcategoria=<?php echo $prodotto["IdCategoria"];?>">Cancella</a></td>
            </tr>
            <?php endforeach;?>
        </tr>
    </table>
</section>