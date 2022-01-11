<!DOCTYPE html>
<html>
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

    <link href="../css/colors.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style_cart.css" rel="stylesheet">
    <title><?php echo $templateParams["titolo"]; ?></title>
</head>
<body class="light_mode">
    <header>
        <!-- Menù iniziale con logo e login-->
        <nav>
            <div><a href="index.php" ><img src="../icons/Logo.png" alt="Website logo" class="icon" /></a></div>
            <!-- Rounded switch -->
        </nav>
    </header>
    <main>
        <div>
            <table>
                <tr>
                    <th>Prodotto</th>
                    <th>Prezzo</th>
                    <th>Quantità</th>
                    <th>Totale</th>
                </tr>
                <?php foreach($templateParams["ordini"] as $ordine): ?>
                <tr>
                    <td><a href="#"><img src="<?php echo $ordine["Immagine"];?> alt="Product image" /></a><p>"<?php echo $ordine["NomeProdotto"];?> Taglia:<?php echo $ordine["Taglia"];?> Colore:<?php echo $ordine["Colore"];?>"</td>
                    <td class="price"><?php echo $ordine["Prezzo"]; ?></td>
                    <td><div class="quantity buttons_added">
                            <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="<?php echo $ordine["Quantità"]; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                        </div>
                    </td>
                    <td name="Totale"></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="footer">
            <div>
                <div>
                    <span>Indirizzo di consegna:</span>
                    <input type="text" id="indirizzo" name="indirizzo"/>
                </div>
                <div>
                    <span>Scelta spedizione:</span>
                    <input type="radio" id="carro_buoi" name="spedizione" value="Carro trainato da buoi"/>
                    <label for="carro_buoi">Carro trainato da buoi(+5$)</label><br>
                    <input type="radio" id="carro_cavalli" name="spedizione" value="Carro trainato da cavalli"/>
                    <label for="carro_cavalli">Carro trainato da cavalli(+20$)</label><br>
                </div>
                <div>
                    <span>Modalità di pagamento:</span>
                    <input type="radio" id="monete" name="pagamento" value="Monete"/>
                    <label for="monete">Monete (Pagamento alla consegna)</label><br>
                    <input type="radio" id="gemme" name="pagamento" value="Gemme"/>
                    <label for="gemme">Gemme (Pagamento alla consegna)</label><br>
                    <input type="radio" id="paypal" name="pagamento" value="Paypal"/>
                    <label for="Paypal">Paypal (**Strumento del demonio utilizzabile solo previa benedizione del vescovo locale)</label><br>
                </div>
            </div>
        </div>
        <div class="sticky-bottom">
            <p>Totale:</p>
            <div class="button-buy">
            <a class="effect1" href="#">
              Compra!
            <span class="bg"></span>
            </a>
        </div>
    </main>
</body>
</html>