<?php

    include_once 'apipeliculas.php';
    
    $api = new ApiPeliculas();
    $nombre = '';
    $error = '';

    if(isset($_POST['nombre']) && isset($_FILES['imagen'])){

        if($api->subirImagen($_FILES['imagen'])){
            $item = array(
                'nombre' => $_POST['nombre'],
                'imagen' => $api->getImagen()
            );
            $api->add($item);
        }else{
            $api->error('Error con el archivo: ' . $api->getError());
        }
    }else{
        $api->error('Error al llamar a la API');
    }

/*
Este código es el encargado de procesar la petición HTTP POST para agregar una nueva película a través de la API. El código primero verifica que se hayan enviado los parámetros "nombre" e "imagen" en la solicitud POST, y luego utiliza el método "subirImagen" de la clase "ApiPeliculas" para validar y guardar la imagen en el servidor.

Si la imagen se sube correctamente, se crea un array con el nombre de la película y la ubicación de la imagen en el servidor, y se llama al método "add" de la clase "ApiPeliculas" para agregar la nueva película a la base de datos.

Si la imagen no se sube correctamente, se llama al método "error" de la clase "ApiPeliculas" para devolver un mensaje de error al cliente. Si la solicitud POST no contiene los parámetros esperados, también se llama al método "error".
*/
    
?>