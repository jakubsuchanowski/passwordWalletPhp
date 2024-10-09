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
<div class="dashboard-head">
    <a href="?action=addPassword"><button type="button">Dodaj hasło</button></a>
    </div>
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
        
        <td class="actions">
        <a href="#" onclick="document.getElementById('show-button').submit();return false;">
                <button type="button" class="show-button" id="show-button">Pokaż hasło</button>
        </a>
            <form action="?action=showPassword&id= <?php echo $password['id'] ?>" style="display:none">
                <input type="hidden" name="show" value="true"></form>
        <a href="?action=updatePassword&id=<?php echo $password['id']; ?>">
            <button type="button" class="update-button" name="update-button">Edytuj hasło</button>
        </a>
        <a href="#" onclick="document.getElementById('delete-pass-form').submit();return false;">
            <button type="button" class="delete-button" name="delete-button">Usuń hasło</button>
        </a>
            <form id="delete-pass-form"action="?action=deletePassword&id=<?php echo $password['id']?>" method="POST" style="display:none;">
            <input type="hidden" name="delete" value="true"></form>
            </td>
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