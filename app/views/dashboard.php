<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/app.css"> 
    <title>Document</title>
</head>
<body>
<div class="navbar">
    <form class="logout-form" action="?action=logout" method="POST">
    <button type="submit" name="logout">Wyloguj</button>
    </form>
</div>
    <h2>Cześć <?php echo $_SESSION['username']?>, jesteś zalogowany.</h2>
    <a href="?action=addPassword"><button type="button">Dodaj hasło</button></a>
    <?php if (!empty($passwords)): ?>
        <div class="table-container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">website</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($passwords as $password): ?>
    <tr>
    
        <td><?php echo htmlspecialchars($password['id']);?></td>
        <td><?php echo htmlspecialchars($password['website']);?></td>
        <td><?php echo htmlspecialchars($password['login']);?></td>
        <td><?php echo htmlspecialchars($password['password']);?></td>
        
        <td>
            <a href="?action=updatePassword&id=<?php echo $password['id']; ?>">
                <button type="button" name="update-button">Edytuj hasło</button></a>
            <form action="deletePassword" method="POST">
            <button type="submit">Usuń hasło</button>
        </form></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php else: ?>
    <p>Brak haseł do wyświetlenia.</p>
<?php endif; ?>
    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>