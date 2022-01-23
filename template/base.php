<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>

    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>

    <link href="../css/product_page.css" rel="stylesheet">
    <link href="../css/colors.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/desktop.css" rel="stylesheet">
    <link href="../css/styleAcc.css" rel="stylesheet">
    <link href="../css/single_product.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <?php if(basename($_SERVER['PHP_SELF'])=="cart.php"): ?>
        <link href="../css/style_cart.css" rel="stylesheet">
    <?php endif; ?>
    <title><?php echo $templateParams["titolo"]; ?></title>
</head>
<body class="<?php echo $templateParams["mode"]; ?>">
    <header>
        <!-- Menù iniziale con logo e login-->
        <nav>
            <a class="logo" href="index.php" ><img src="../icons/Logo.png" alt="Website logo" class="icon" /></a>
            <a class="removable" href="index.php"><h1><?php echo $templateParams["webtitle"]; ?></h1></a>
            <?php if(isUserLoggedIn()): ?>
                <a class="account"><img src="../icons/Login_modern.png" alt="User logo" class="icon" /><p><?php echo $templateParams["utente"][0]["Nome"]; ?></p></a>
                <a class="cart" href="cart.php" ><img src="../icons/Carrello_modern.png" alt="Cart logo" class="icon" /><?php if($templateParams["cartnumber"] > 0):?><span class="badge"></span><?php endif;?><p>Carrello</p></a>
            <?php elseif(basename($_SERVER['PHP_SELF'])=="login.php"): ?>
                <a class="login" href="sign.php"><img src="../icons/Login_modern.png" alt="Login logo" class="icon" /><p>Registrati</p></a>
            <?php else: ?>
                <a class="login" href="login.php"><img src="../icons/Login_modern.png" alt="Login logo" class="icon" /><p>Accedi</p></a>
            <?php endif; ?> 
            <a class="menu"><img src="../icons/menu.png" alt="General menu logo" class="icon" /><p>Menu</p></a>
        </nav>
    </header>
    <ul class="history">
        <li>
            Close
        </li>
        <?php foreach($templateParams["storico"] as $storico):?>
        <li name="<?php echo $storico["IdOrdine"]?>">
            <?php echo "ID Ordine: ".$storico["IdOrdine"]." Stato: ".$storico["Stato"]; ?>
            <div class="progress-container">
                <div class="progress"></div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <ul class="notify">
        <li>
            Close
        </li>
        <?php foreach($templateParams["ordini"] as $ordine):?>
        <li>
            <?php echo "Hai aggiunto a carrello: ".$ordine["NomeProdotto"]." Taglia: ".$ordine["Taglia"]." Colore: ".$ordine["Colore"]; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <!--Menù categorie a comparsa-->
    <div class="accordion">
        <button>
                Categorie
        </button>
        <ul>
            <li>
                <a href="product.php?categoryName=All">Tutti i prodotti</a>
            </li>
            <?php foreach($templateParams["categorie"] as $categoria): ?>
            <li>
                <a href="product.php?categoryName=<?php echo $categoria["NomeCategoria"];?>"><?php echo $categoria["NomeCategoria"];?></a>
            </li>
            <?php endforeach; ?>
            <li>
                <a href="product.php?categoryName=Saldi">Saldi</a>
            </li>     
        </ul>
        <a href="">Contatti</a>
    </div>
    <!--Menù a comparsa quando si clicca sull'icona account-->
    <div class="account_background">
        <div class="account_navigation">
            <ul>
                <li class="list">
                    <a href=#>
                        <span class="icon_A_nav"><img src="../icons/prince.png" alt="My account logo"/></span>
                        <span class="text_A_nav">Profilo</span>
                    </a>
                </li>
                <li class="list" id="storico">
                    <a href=#>
                        <span class="icon_A_nav"><img src="../icons/fantasy.png" alt="My orders logo"/><?php if($templateParams["cartnumber"] > 0):?><span class="badge"></span><?php endif;?></span>
                        <span class="text_A_nav">Storico</span>
                    </a>
                </li>
                <li id="messaggi" class="list">
                    <a href=#>
                        <span class="icon_A_nav"><img src="../icons/message.png" alt="My messages logo"/><?php if($templateParams["cartnumber"] > 0):?><span class="badge"></span><?php endif;?></span>
                        <span class="text_A_nav">Messaggi</span>
                    </a>
                </li>
                <li id="light" class="list">
                    <a href=#>
                        <span class="icon_A_nav"><img src="../icons/candle.png" alt="Light logo"/></span>
                        <span class="text_A_nav">Dark mode</span>
                    </a>
                </li>
                <li class="list">
                    <a href="logout.php" >
                        <span class="icon_A_nav"><img src="../icons/gate.png" alt="Logout logo"/></span>
                        <span class="text_A_nav">Logout</span>
                    </a>
                </li>
                <div class="indicator"></div>
            </ul>
        </div>
    </div>
    <div class="snackbar"></div>
    <!-- Menù categorie -->
    <?php if($templateParams["nome"] != "../template/login-form.php" && $templateParams["nome"] != "../template/signUp-form.php" && $templateParams["nome"] != "../template/shopping_cart.php") :?>
        <nav class="stickynav">
            <ul id="stickyNav">
                <?php foreach($templateParams["categorie"] as $categoria): ?><li><a href="product.php?categoryName=<?php echo $categoria["NomeCategoria"]; ?>"><img src="<?php echo UPLOAD_DIR.$categoria["ImmagineCategoria"]; ?>" alt="<?php echo $categoria["NomeCategoria"]; ?> category logo" class="icon" /><p><?php echo $categoria["NomeCategoria"]; ?></p></a></li><?php endforeach; ?>
            </ul>
        </nav>
    <?php endif;?>
    <main >
        <?php
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }
        ?>
    </main>
    <footer>
        <section>
            <h3>Torna su</h3>
            <a href="#" ><div><img src="../icons/shield_color.png" alt="Website Logo"/></div><p><?php echo $templateParams["webtitle"]; ?></p></a>
        </section>
        <section>
            <h3>Trovaci su</h3>
            <a href="https://www.instagram.com/" target="_blank"><div><img src="../icons/artboard.png" alt="Medieval Instagram Logo"/></div><p>Pittura</p></a>
            <a href="https://www.facebook.com/" target="_blank"><div><img src="../icons/manuscript.png" alt="Medieval Facebook Logo"/></div><p>Faccialibro</p></a>
            <a href="https://twitter.com/?lang=en" target="_blank"><div><img src="../icons/carrier-pigeon.png" alt="Medieval Twitter Logo"/></div><p>Cinguettio</p></a>
        </section>
        <section>
            <h3>Metodi di pagamento</h3>
            <div><img src="../icons/gem_color.png" alt="Gem Payment"/></div>
            <div><img src="../icons/paypal.png" alt="Paypal Logo"/></div>
            <div><img src="../icons/money-bag_color.png" alt="Cash Payment"/></div>
        </section>    
    </footer>
</body>
</html>