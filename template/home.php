<section>
        <h2>Più venduti</h2>
        <div class="slideshow-container fade">
        <?php $i = 1; ?>
        <?php foreach($templateParams["bestseller"] as $key=>$prodotto): ?>
            <div class="Containers">
              <div class="MessageInfo"><?php echo $i;?>/<?php echo count($templateParams["bestseller"]);?></div>
              <a href="../php/productCard.php?productId=<?php echo $prodotto["IdProdotto"];?>&categoryId=<?php echo $prodotto["IdCategoria"];?>"><img src="<?php echo UPLOAD_DIR.$templateParams["imagesBest"][$key][0]["URL"];?>" alt="<?php $prodotto["NomeProdotto"];?> image"></a>
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