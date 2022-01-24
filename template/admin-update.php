<form action="#" method="POST">
    <h2>Aggiorna quantità</h2>
    <?php if(isset($templateParams["erroreAzione"])): ?>
                <p><?php echo $templateParams["erroreAzione"]; ?></p>
            <?php endif; ?>
    <table class="admintable">
        <tr>
            <th>NomeProdotto</th><th>Immagine</th><th>Colore</th><th>Azione</th>
            <?php foreach($templateParams["prodotti"] as $key=>$prodotto): ?>
            <tr>
                <td>
                    <?php echo $prodotto["NomeProdotto"];?>
                </td>
                <td><img src="<?php echo UPLOAD_DIR.$templateParams["images"][$key][0]["URL"];?>" alt=""></td>
                <td><?php $colors = $dbh->getOpzioni( $prodotto["IdProdotto"],$prodotto["IdCategoria"]); foreach($colors as $key=>$opzione): ?>
                    <input type="radio" id="opzione" name="opzione" value="<?php $opzione["Colore"];?>" />
                    <label for="opzione"><?php echo $opzione["Colore"];?></label>
                    <?php endforeach; ?></td>
                    <label for="idprodotto"> </label>
                    <input type="text" id="idprodotto" name="idprodotto" value="<?php echo $prodotto["IdProdotto"];?>" hidden  disabled/>
                    <label for="categoria"> </label>
                    <input type="text" id="categoria" name="categoria" value="<?php echo $prodotto["IdCategoria"];?>" hidden  disabled/>
                <td><input type="submit" name="submit" value="Update" /></td>
            </tr>
            <?php endforeach;?>
        </tr>
    </table>
</form>