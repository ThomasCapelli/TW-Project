<form action="#" method="POST">
    <h2>Accedi</h2>
    <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">Username</label>
            <input type="text" id="username" name="username"/>
        </li>
        <li>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"/>
        </li>
        <li>
            <input type="submit" name="submit" value="Accedi"/>      
        </li>
        <li>
            <p>Non hai ancora un profilo? <a href="sign.php">Registrati qui!</a></p>
        </li>  
    </ul>   
</form>