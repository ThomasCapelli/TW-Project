<form action="upload.php" method="POST" enctype="multipart/form-data">
            <h2>Inserisci</h2>
            <?php if(isset($templateParams["erroreInserimento"])): ?>
                <p><?php echo $templateParams["erroreInserimento"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="nomeprodotto">NomeProdotto</label>
                    <input type="text" id="nomeprodotto" name="nomeprodotto" required/>
                </li>
                <li>
                    <label for="descrizione">Descrizione</label>
                    <textarea id="descrizione" name="descrizione" required></textarea>
                </li>
                <li>
                    <label for="descrizione_breve">Descrizione breve</label>
                    <textarea id="descrizione_breve" name="descrizione_breve" required></textarea>
                </li>
                <li>
                <?php foreach($templateParams["categorie"] as $categoria): ?>
                    <input type="radio" id="categoria<?php echo $categoria["IdCategoria"];?>" name="categoria" value="<?php echo $categoria["IdCategoria"];?>" />
                    <label for="categoria<?php echo $categoria["IdCategoria"];?>"><?php echo $categoria["NomeCategoria"]; ?></label>
                    <?php endforeach; ?>
                </li>
                <li>
                    <label for="imgprodotto">Immagine</label>
                    <input type="file" name="imgprodotto" id="imgprodotto" />
                    
                </li>
                <li>
                    <label for="prezzo">Prezzo</label>
                    <input type="number" id="prezzo" name="prezzo" min="0" step="0.1" required/>
                </li>
                <li>
                    <label for="sconto">Sconto</label>
                    <input type="number" id="sconto" name="sconto" required/>
                </li>
                <li>
                    <label for="colore">Colore</label>
                    <input type="text" id="colore" name="colore" required/>
                </li>
                <li>
                    <label for="taglia">Taglia</label>
                    <input type="text" id="taglia" name="taglia" required/>
                </li>
                <li>
                    <label for="quantita">Quantità</label>
                    <input type="number" id="quantita" name="quantita" min="0" step="1" required/>
                </li>
                <li>
                <?php foreach($templateParams["produttori"] as $produttore): ?>
                    <input type="radio" id="produttore<?php echo $produttore["IdProduttore"];?>" name="produttore" value="<?php echo $produttore["IdProduttore"];?>" />
                    <label for="produttore<?php echo $produttore["IdProduttore"];?>"><?php echo $produttore["Nome"]; ?></label>
                    <?php endforeach; ?>
                </li>
                <li>
                    <input type="submit" name="submit" value="Inserici" />
                </li>
            </ul>
</form>