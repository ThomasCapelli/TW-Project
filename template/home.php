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
            <?php foreach($templateParams["bestseller"] as $prodotto): ?>
                <span class="dots"></span>
            <?php endforeach; ?>
        </div>
        
</section>
<section id="forsale">
            <header>
                <h2>Ultime offerte</h2>
                <a href="product.php?categoryName=Saldi">Vedi tutte</a>
            </header>
            <?php if(isset($templateParams["prod"])) {
                require($templateParams["prod"]);
            }
            ?>
</section>