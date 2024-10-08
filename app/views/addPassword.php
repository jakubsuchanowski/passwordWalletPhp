<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/app.css"> 
    <title>Document</title>
</head>
<body>
<?php include 'navbar.php'; ?>
    <form action="?action=addPassword" method="POST">
        <label for="website">Nazwa strony</label><br>
        <input type="text" name="website" required><br>
        <label for="username">Login</label><br>
        <input type="text" name="username" required><br>
        <label for="password">Hasło</label><br>
        <input type="password" name="password" required><br>
        <div class="button-container">
        <button type="submit" name="add-password-btn" id="add-password-btn">Dodaj</button>
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