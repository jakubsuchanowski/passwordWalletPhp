<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/app.css"> 
    <title>Rejestracja</title>
</head>
<body>
    <form action="?action=register" method="POST">
    <label for="username">Login</label><br>
    <input type="text" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" name="password"><br>
    <div class="button-container">
    <button type="submit">Zarejestruj</button><br>
    </div>
    Masz konto?<a href="?action=login">Przejdz do logowania</a>
    </form>
   
    
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>