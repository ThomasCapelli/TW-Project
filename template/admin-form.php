<form action="#" method="POST">
            <h2>Inserisci</h2>
            <ul>
                <li>
                    <label for="nomeprodotto">NomeProdotto</label>
                    <input type="text" id="nomeprodotto" name="nomeprodotto" required/>
                </li>
                <li>
                    <label for="descrizione">Descrizione</label>
                    <textarea id="descrizione" name="descrizione" required></textarea>
                </li>
                <li>
                    <label for="descrizione_breve">Descrizione breve</label>
                    <textarea id="descrizione_breve" name="descrizione_breve" required></textarea>
                </li>
                <li>
                    <label for="prezzo">Prezzo</label>
                    <input type="number" id="prezzo" name="prezzo" required/>
                </li>
                <li>
                    <label for="sconto">Sconto</label>
                    <input type="number" id="sconto" name="sconto" required/>
                </li>
                <li>
                    <input type="submit" name="submit" value="Inserici" disabled/>
                </li>
            </ul>
</form>