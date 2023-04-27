<?php
header('Access-Control-Allow-Origin: *');

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'peliculas';
        $this->user     = 'root';
        $this->password = "";
        $this->charset  = 'utf8mb4';
    }

    function connect(){
    
        try{

            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($connection,$this->user,$this->password);
        
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}
/*
Este código define una clase llamada "DB" que se utiliza para conectarse a una base de datos MySQL utilizando la extensión PDO (PHP Data Objects).

En el constructor de la clase, se establecen los valores predeterminados para el host, la base de datos, el usuario, la contraseña y el conjunto de caracteres utilizados en la conexión.

La función "connect" es responsable de establecer la conexión real con la base de datos utilizando los valores predeterminados establecidos en el constructor.

La función utiliza la cadena de conexión de MySQL para establecer la conexión utilizando los parámetros del host, base de datos y conjunto de caracteres. También se establecen algunas opciones para PDO, como el modo de error y la emulación de preparación, que se configuran para lanzar excepciones en caso de errores y evitar la emulación de sentencias preparadas.

Si se establece correctamente la conexión, la función devuelve el objeto PDO que se puede utilizar para interactuar con la base de datos. Si hay un error durante la conexión, se captura la excepción PDOException y se imprime un mensaje de error en la pantalla.
*/
?>