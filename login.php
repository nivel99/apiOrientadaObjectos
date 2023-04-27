<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="procesar_login.php" method="POST">
  <label for="email">Correo electrónico:</label>
  <input type="email" id="email" name="email" required>

  <label for="password">Contraseña:</label>
  <input type="password" id="password" name="password" required>

  <button type="submit">Iniciar sesión</button>
</form>
</body>
</html>