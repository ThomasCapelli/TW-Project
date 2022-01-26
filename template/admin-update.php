<form>
    <h2>Aggiorna quantità</h2>
    <?php if(isset($templateParams["erroreAzione"])): ?>
                <p><?php echo $templateParams["erroreAzione"]; ?></p>
            <?php endif; ?>
    <table class="admintable">
        <tr>
            <th>NomeProdotto</th><th>Immagine</th><th>Colore</th><th>Taglia</th><th>Quantità</th><th>Azione</th></tr>
            <?php foreach($templateParams["prodotti"] as $key=>$prodotto): ?>
            <tr>
                <td title="<?php echo $prodotto["IdProdotto"];?>">
                    <?php echo $prodotto["NomeProdotto"];?>
                </td>
                <td title="<?php echo $prodotto["IdCategoria"];?>"><img src="<?php echo UPLOAD_DIR.$prodotto["URL"];?>" alt="<?php echo $prodotto["NomeProdotto"];?>"></td>
                <td><?php echo $prodotto["Colore"];?></td>
                <td><?php echo $prodotto["Nome_taglia"];?></td>
                <td><?php echo $prodotto["Quantita"];?></td>
                <td><button class="update">Update</button></td>
            </tr>
            <?php endforeach;?>
    </table>
</form>