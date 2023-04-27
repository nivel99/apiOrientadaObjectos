<?php

include_once 'pelicula.php';

class ApiPeliculas{

    private $error;
    private $imagen;


    function getAll(){
        $pelicula = new Pelicula();
        $peliculas = array();
        $peliculas["items"] = array();

        $res = $pelicula->obtenerPeliculas();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "imagen" => $row['imagen'],
                );
                array_push($peliculas["items"], $item);
            }
        
            $this->printJSON($peliculas);
        }else{
            $this->error('No hay elementos');
        }
    }

    function getById($id){
        $pelicula = new Pelicula();
        $peliculas = array();
        $peliculas["items"] = array();

        $res = $pelicula->obtenerPelicula($id);

        if($res->rowCount() == 1){
            $row = $res->fetch();
        
            $item=array(
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "imagen" => $row['imagen'],
            );
            array_push($peliculas["items"], $item);
            $this->printJSON($peliculas);
        }else{
            $this->error('No hay elementos');
        }
    }

    function add($item){
        $pelicula = new Pelicula();

        $res = $pelicula->nuevaPelicula($item);
        $this->exito('Nueva pelicula registrada');
    }


    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }

    function subirImagen($file){
        $directorio = "imagenes/";

    
        // valida que es imagen
        $checarSiImagen = getimagesize($file["tmp_name"]);
    
        if($checarSiImagen != false){
            //validando tamaño del archivo
            $size = $file["size"];
    
            if($size > 1500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{
                // se genera un nombre único para la imagen
                $nombreImagen = uniqid().".jpg";
                $archivo = $directorio . $nombreImagen;

                $this->imagen = $nombreImagen;
                $tipoArchivo = strtolower(pathinfo($this->imagen, PATHINFO_EXTENSION));
    
                //validar tipo de imagen
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }
    
    
    

    function getImagen(){
        return $this->imagen;
    }

    function getError(){
        return $this->error;
    }
}

/*
Este código define una clase llamada ApiPeliculas que tiene diferentes funciones que manejan la API de películas. A continuación, se describe brevemente cada una de estas funciones:

getAll(): obtiene todas las películas de la base de datos y las devuelve como un objeto JSON.
getById($id): obtiene la película correspondiente al ID proporcionado y la devuelve como un objeto JSON.
add($item): agrega una nueva película a la base de datos y devuelve un mensaje de éxito como un objeto JSON.
error($mensaje): muestra un mensaje de error como un objeto JSON.
exito($mensaje): muestra un mensaje de éxito como un objeto JSON.
printJSON($array): convierte el array proporcionado en un objeto JSON y lo muestra en la pantalla.
subirImagen($file): valida y sube una imagen proporcionada por el usuario al servidor. Retorna un valor booleano para indicar si se pudo subir la imagen correctamente o no.
getImagen(): devuelve la ruta de la imagen subida.
getError(): devuelve el mensaje de error correspondiente.
La clase ApiPeliculas utiliza la clase Pelicula, que se define en el archivo pelicula.php, para interactuar con la base de datos y obtener información de las películas. La clase Pelicula extiende la clase DB, que se define en el archivo db.php, para manejar la conexión con la base de datos.
*/

?>