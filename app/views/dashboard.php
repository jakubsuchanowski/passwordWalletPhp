<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="?action=logout" method="POST">
    <button type="submit" name="logout">Wyloguj</button>
    </form>
    <h2>Hej <?php echo $_SESSION['username']?>, jesteś zalogowany.</h2>
    <a href="?action=addPassword"><button type="button">Dodaj hasło</button></a>
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
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>

    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>