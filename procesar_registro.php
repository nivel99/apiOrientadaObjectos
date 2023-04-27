<?php
include_once 'Usuario.php';

$usuario = new Usuario();

if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password'])) {
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$resultado = $usuario->registro($nombre, $email, $password);

	if($resultado === true) {
		echo 'Registro exitoso';
	} else {
		echo $resultado;
	}
} else {
	echo 'Por favor complete todos los campos';
}
?>
