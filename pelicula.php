<?php

include_once 'db.php';

class Pelicula extends DB{
    
    function obtenerPeliculas(){
        $query = $this->connect()->query('SELECT id, nombre, imagen FROM pelicula');
        return $query;
    }

    function obtenerPelicula($id){
        $query = $this->connect()->prepare('SELECT id, nombre, imagen FROM pelicula WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query;
    }

    function nuevaPelicula($pelicula){
        $query = $this->connect()->prepare('INSERT INTO pelicula (nombre, imagen) VALUES (:nombre, :imagen)');
        $query->execute(['nombre' => $pelicula['nombre'], 'imagen' => $pelicula['imagen']]);
        return $query;
    }

}

/*
Este código define una clase llamada "Pelicula" que extiende la clase "DB", lo que significa que tiene acceso a las funciones de conexión a la base de datos definidas en la clase "DB".

La clase "Pelicula" tiene tres funciones públicas:

La función "obtenerPeliculas()" que ejecuta una consulta SQL para obtener todas las películas de la tabla "pelicula" en la base de datos.

La función "obtenerPelicula($id)" que ejecuta una consulta SQL para obtener una película específica de la tabla "pelicula" en la base de datos, utilizando un parámetro de id para filtrar los resultados.

La función "nuevaPelicula($pelicula)" que ejecuta una consulta SQL para agregar una nueva película a la tabla "pelicula" en la base de datos, utilizando los valores proporcionados en el array $pelicula.

Cada una de estas funciones utiliza la función "connect()" de la clase "DB" para conectarse a la base de datos y ejecutar la consulta SQL.

La función "obtenerPelicula($id)" utiliza la función prepare() de PDO para preparar la consulta SQL con un parámetro :id que se reemplazará con el valor proporcionado en la llamada a la función.

La función "nuevaPelicula($pelicula)" utiliza la función prepare() de PDO para preparar la consulta SQL con dos parámetros :nombre y :imagen que se reemplazarán con los valores proporcionados en el array $pelicula.

En cada caso, la función devuelve un objeto PDOStatement que se puede usar para recorrer los resultados de la consulta SQL o verificar si la consulta SQL fue exitosa.
*/

?>