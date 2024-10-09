<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/app.css"> 
    <title>Login</title>
</head>
<body>
    <form action="?action=login" method="POST">
    <label for="username">Login</label><br>
    <input type="text" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" name="password"><br>
    <!-- <label>Rodzaj szyfrowania:</label>
    <input type="radio" name="encryptOption" value="HMAC">HMAC</input>
    <input type="radio" name="encryptOption" value="Sha512">SHA512</input><br> -->
    <div class="button-container">
    <button class="login-button" type="submit">Zaloguj</button><br>
    </div>
    Nie masz konta?<a href="?action=register">Zarejestruj się</a>
    </form>
    
    
    
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>