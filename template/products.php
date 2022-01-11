<a href="shopping_cart.php" id="cartbutton"><img src="../Icons/Carrello_modern.png" alt="Cart fixed link"></a>
    <section id="products">
        <header>
            <h2><?php echo $templateParams["categoria"]?></h2>
        </header>
        <?php if(isset($templateParams["prod"])) {
            require($templateParams["prod"]);
        }
        ?>
    </section>