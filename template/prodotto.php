
<ul>
    <?php foreach($templateParams["prodotti"] as $prodotto):?>
    <li>
        <a href="../php/productCard.php?productId=<?php echo $prodotto["IdProdotto"];?>&categoryId=<?php echo $prodotto["IdCategoria"];?>" >
            <article>
                <header>
                    <div>
                        <img src="../icons/fleur-de-lis.png"/>
                    </div>
                </header>
                <section>
                    <h3><?php echo $prodotto["NomeProdotto"];?></h3>
                        <p><?php echo $prodotto["Descrizione_Breve"];?></p>
                    <?php if($prodotto["Sconto"] != 0):?>
                        <del><?php echo $prodotto["Prezzo"]; ?>&#8364;</del>
                        <p><?php echo calculatePrice($prodotto["Prezzo"], $prodotto["Sconto"]) ?>&#8364;</p>
                    <?php else:?>
                        <p><?php echo $prodotto["Prezzo"]; ?>&#8364;</p>
                    <?php endif;?>
                </section>
            </article>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
    