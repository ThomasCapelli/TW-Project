<section>
        <h2>Più venduti</h2>
        <div class="slideshow-container fade">
        <?php $i = 1; ?>
        <?php foreach($templateParams["bestseller"] as $prodotto): ?>
            <div class="Containers">
              <div class="MessageInfo"><?php echo $i;?>/<?php echo count($templateParams["bestseller"]);?></div>
              <img src="../icons/catapult_large.jpg">
              <div class="Info"><?php echo $prodotto["Descrizione_Breve"];?></div>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
            <!-- Back and forward buttons -->
            <a class="back">&#10094;</a>
            <a class="forward">&#10095;</a>
        </div>
      
          <!-- The circles/dots -->
        <div>
            <span class="dots first"></span>
            <span class="dots second"></span>
            <span class="dots third"></span>
        </div> 
</section>
<section id="forsale">
            <header>
                <h2>Ultime offerte</h2>
                <a href="">Vedi tutte</a>
            </header>
            <ul>
                <?php foreach($templateParams["scontati"] as $scontato): ?>
                <li>
                    <a href="" >
                        <article>
                            <header>
                                <div>
                                    <img src="../icons/fleur-de-lis.png"/>
                                        </div>
                            </header>
                            <section>
                                <h3><?php echo $scontato["NomeProdotto"]; ?></h3>
                                <p><?php echo $scontato["Descrizione_Breve"]; ?></p>
                                <del><?php echo $scontato["Prezzo"]; ?></del>
                                <p><?php echo calculatePrice($scontato["Prezzo"], $scontato["Sconto"]) ?></p>
                            </section>
                        </article>
                    </a>     
                </li> 
                <?php endforeach; ?>         
            </ul>
</section>