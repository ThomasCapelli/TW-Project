<div>
    <table>
        <tr>
            <th>Prodotto</th>
            <th>Prezzo</th>
            <th>Quantità</th>
            <th>Totale</th>
        </tr>
        <?php
            $cont=0; ?>
        <?php foreach($templateParams["ordini"] as $ordine): ?>
        <tr>
        <td><button type="button" name="<?php echo $ordine["IdDettaglioOrdine"];?>" title="Rimuovi elemento" class="remove_button">X</button><a href="#"><img src="<?php echo UPLOAD_DIR.$ordine["URL"];?>" alt="Product image" /></a><p><?php echo $ordine["NomeProdotto"];?> Taglia:<?php echo $ordine["Taglia"];?> Colore:<?php echo $ordine["Colore"];?></p></td>
            <td class="price"><?php echo $ordine["Prezzo"]; ?></td>
                <td>
                    <div class="quantity buttons_added">
                        <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="<?php echo $templateParams["taglie"][$cont]["Quantita"]; ?>" name="quantity" value="<?php echo $ordine["Quantita"]; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                        <?php $cont=$cont +1;?>
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
            <label for="paypal">Paypal (**Strumento del demonio utilizzabile solo previa benedizione del vescovo locale)</label><br>
        </div>
        <div>
            <span>Email:</span>
            <input type="text" id="emailPaypal" name="emailPaypal"/>
            <span>Password:</span>
            <input type="password" id="passwordPaypal" name="passwordPaypal"/>
        </div>
    </div>
</div>
<div class="sticky-bottom">
    <p>Totale:</p>
    <div class="button-buy">
        <a class="effect1" href=#>Compra!<span class="bg"></span></a>
    </div>
</div>