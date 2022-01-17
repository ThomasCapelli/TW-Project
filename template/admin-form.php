<form action="#" method="POST">
            <h2>Inserisci</h2>
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
                    <input type="radio" id="<?php echo $categoria["NomeCategoria"]; ?>" name="radio" <?php 
                    ?> /><label for="<?php echo $categoria["NomeCategoria"]; ?>"><?php echo $categoria["NomeCategoria"]; ?></label>
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
                <?php foreach($templateParams["produttori"] as $produttore): ?>
                    <input type="radio" id="<?php echo $produttore["Nome"]; ?>" name="radio" <?php 
                    ?> /><label for="<?php echo  $produttore["Nome"]; ?>"><?php echo  $produttore["Nome"]; ?></label>
                    <?php endforeach; ?>
                </li>
                <li>
                    <input type="submit" name="submit" value="Inserici" />
                </li>
            </ul>
</form>