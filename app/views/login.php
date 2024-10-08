<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="?action=login" method="POST">
    <label for="username">Login</label><br>
    <input type="text" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" name="password"><br>
    <button type="submit">Zaloguj</button><br>
    </form>
    Nie masz konta?<a href="?action=register">Zarejestruj się</a>
    
    
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>