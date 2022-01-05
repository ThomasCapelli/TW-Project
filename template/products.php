<a href="shopping_cart.html" id="cartbutton"><img src="../Icons/Carrello_modern.png" alt="Cart fixed link"></a>
    <section id="products">
        <header>
            <h2><?php echo $templateParams["categoria"]?></h2>
        </header>
        <?php foreach($templateParams["prodotti"] as $prodotto):?>
            <a href="" >
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
                            <del><?php echo $prodotto["Prezzo"]; ?></del>
                            <p><?php echo calculatePrice($prodotto["Prezzo"], $prodotto["Sconto"]) ?></p>
                        <?php else:?>
                            <p><?php echo $prodotto["Prezzo"]; ?></p>
                        <?php endif;?>
                    </section>
                </article>
            </a>
        <?php endforeach; ?>
    </section>