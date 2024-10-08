<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <form action="?action=register" method="POST">
    <label for="username">Login</label><br>
    <input type="text" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" name="password"><br>
    <button type="submit">Zarejestruj</button><br>
    </form>
    
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>