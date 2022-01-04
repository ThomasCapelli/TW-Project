<a href="shopping_cart.html" id="cartbutton"><img src="../Icons/Carrello_modern.png" alt="Cart fixed link"></a>
    <section id="products">
        <header>
            <h2><?php echo $templateParams["categoria"][0]["NomeCategoria"];?></h2>
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
                        <del><?php echo $prodotto["Prezzo"]; ?></del>
                        <p><?php echo calculatePrice($prodotto["Prezzo"], $prodotto["Sconto"]) ?></p>
                    </section>
                </article>
            </a>
        <?php endforeach; ?>
    </section>