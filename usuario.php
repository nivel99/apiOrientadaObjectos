<?php

include_once 'db.php';

class Usuario extends DB {

    function login($email, $password) {
        $query = $this->connect()->prepare('SELECT nombre, email, password , token FROM usuarios WHERE email = :email');
        $query->execute(['email' => $email]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if(!$user) {
            return false;
        }

        if(password_verify($password, $user['password'])) {
            $token = $user['token'];
            return array('token' => $token);
        }

        return false;
    }

    function registro($nombre, $email, $password) {
        $query = $this->connect()->prepare('SELECT nombre, email, password FROM usuarios WHERE email = :email');
        $query->execute(['email' => $email]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user) {
            return 'El email ya está registrado';
        }

        // Generar un token aleatorio de 30 caracteres sin repetir
        do {
            $token = bin2hex(random_bytes(15));
            $query = $this->connect()->prepare('SELECT COUNT(*) as count FROM usuarios WHERE token = :token');
            $query->execute(['token' => $token]);
            $count = $query->fetch(PDO::FETCH_ASSOC)['count'];
        } while ($count > 0);

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->connect()->prepare('INSERT INTO usuarios (nombre, email, password, token) VALUES (:nombre, :email, :password, :token)');
        $query->execute(['nombre' => $nombre, 'email' => $email, 'password' => $password, 'token' => $token]);

        return true;
    }

}
?>
