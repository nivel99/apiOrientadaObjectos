<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="procesar_registro.php">
  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" id="nombre" required>

  <label for="apellido">Apellido:</label>
  <input type="text" name="apellido" id="apellido" required>

  <label for="correo">Correo electrónico:</label>
  <input type="email" name="email" id="email" required>

  <label for="password">Contraseña:</label>
  <input type="password" name="password" id="password" required>

  <label for="confirm_password">Confirmar contraseña:</label>
  <input type="password" name="confirm_password" id="confirm_password" required>

  <button type="submit">Registrarse</button>
</form>

</body>
</html>