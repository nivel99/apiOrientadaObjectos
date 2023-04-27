<?php
include_once 'usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Crear un objeto Usuario
    $usuario = new Usuario();

    // Intentar iniciar sesión con los datos proporcionados
    $resultado = $usuario->login($email, $password);

    // Verificar si el inicio de sesión fue exitoso
    if ($resultado) {
        // Mostrar el token al usuario
        echo "Token:" . $resultado['token'];
    } else {
        // Mostrar un mensaje de error al usuario si el inicio de sesión falla
        echo "Los datos de inicio de sesión son incorrectos.";
    }
}
?>
