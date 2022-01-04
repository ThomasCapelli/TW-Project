<form action="#" method="POST">
    <h2>Accedi</h2>
    <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <div>
                <input type="text" id="username" name="username"/>
                <label for="username">Username</label>
            </div>
        </li>
        <li>
            <div>
                <input type="password" id="password" name="password"/>
                <label for="password">Password</label>
            </div>
        </li>
        <li>
            <div>
                <input type="submit" name="submit" value="Accedi"/>
            </div>          
        </li>
        <li>
            <p>Non hai ancora un profilo? <a href="sign.php">Registrati qui!</a></p>
        </li>  
    </ul>   
</form>