<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/app.css"> 
    <title>Document</title>
</head>
<body>
    <form action="?action=updatePassword" method="POST">
        <input type="hidden" name="id" value="<?php echo $password['id']; ?>">
        <label for="website">Nazwa strony</label><br>
        <input type="text" name="website" value="<?php echo htmlspecialchars($password['website']); ?>" required><br>
        <label for="username">Login</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($password['login']); ?>" required><br>
        <label for="password">Hasło</label><br>
        <input type="password" name="password" required><br>
        <div class="button-container">
        <button type="submit" name="edit-password-btn">Zapisz</button>
        </div>
    </form>
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>