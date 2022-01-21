<article>
        <header>
            <div>
                <img src="<?php echo UPLOAD_DIR.$templateParams["images"][0]["URL"]; ?>" alt="">
            </div>
            <ul class="images">
                <?php foreach($templateParams["images"] as $image): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR.$image["URL"]; ?>" alt="">
                </li>
                <?php endforeach; ?>
            </ul>
        </header>
        <section>
            <h2 class="productName" name="<?php echo $templateParams["quantita"][0]["QuantitaProd"];?>"><?php echo $templateParams["prodotto"][0]["NomeProdotto"]; ?></h2>
            <p><?php echo $templateParams["prodotto"][0]["Descrizione"]; ?></p>
            <?php if($templateParams["prodotto"][0]["Sconto"] != 0):?>
                <del><?php echo $templateParams["prodotto"][0]["Prezzo"]; ?>&#8364;</del>
                <p><?php echo calculatePrice($templateParams["prodotto"][0]["Prezzo"], $templateParams["prodotto"][0]["Sconto"]) ?>&#8364;</p>
            <?php else:?>
                <p><?php echo $templateParams["prodotto"][0]["Prezzo"]; ?></p>
            <?php endif;?>
        </section>
        <footer>
            <ul class="colors">
            <?php foreach($templateParams["opzioni"] as $opzione):?>
                <li>
                    <a href="../php/productCard.php?productId=<?php echo $templateParams["prodotto"][0]["IdProdotto"];?>&categoryId=<?php echo $templateParams["prodotto"][0]["IdCategoria"];?>&colore=<?php echo $opzione["Colore"];?>">
                    <img <?php if($templateParams["maincolor"][0]["Colore"] == $opzione["Colore"]): ?>
                        <?php echo "class='activate'"; ?>
                        <?php endif;?> src="../Icons/candle.png" alt=""></a>
                    <p <?php if($templateParams["maincolor"][0]["Colore"] == $opzione["Colore"]): ?> <?php echo "class='colorName'"; ?><?php endif;?>><?php echo $opzione["Colore"];?></p>
                </li>
            <?php endforeach;?>
            </ul>
            <button type="button">Seleziona taglia</button>
            <ul class="size">
                <li>
                    <p>X</p>
                </li>
                <?php foreach($templateParams["taglie"] as $taglia):?>
                <li>
                    <label for="<?php echo $taglia["Nome_taglia"];?>"><?php echo $taglia["Nome_taglia"];?></label>
                    <input type="radio" name="size" id="<?php echo $taglia["Nome_taglia"]." ".$taglia["Quantita"];?>" value="<?php echo $taglia["Nome_taglia"];?>"/>
                </li>
                <?php endforeach;?>
            </ul>
                <button class="addToCart" type="button">Aggiungi al carrello</button>
        </footer>
</article>
