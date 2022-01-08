<form action="#" method="POST">
            <h2>Registrati</h2>
            <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="email">Email*</label>
                    <input type="text" id="email" name="email" required/>
                    <?php if(isset($templateParams["erroreEmail"])): ?>
                        <p><?php echo $templateParams["erroreEmail"]; ?></p>
                    <?php endif; ?>
                </li>
                <li>
                    <label for="nome">Nome*</label>
                    <input type="text" id="nome" name="nome" required="true"/>
                </li>
                <li>
                    <label for="cognome">Cognome*</label>
                    <input type="text" id="cognome" name="cognome" required/>
                </li>
                <li>
                    <label for="data" class="moved">DataNascita*</label>
                    <input type="date" id="data" name="data" required/>
                </li>
                <li>
                    <label for="password">Password*</label>
                    <input type="password" id="password" name="password" required/>
                </li>
                <li>
                    <label for="confirm">Conferma password*</label>
                    <input type="password" id="confirm" name="confirm" required/>
                </li>
                <li>
                    <label for="indirizzo">Indirizzo*</label>
                    <input type="text" id="indirizzo" name="indirizzo" required/>
                </li>
                <li>
                    <input type="submit" name="submit" value="Registrati" disabled/>
                </li>
            </ul>
        </form>