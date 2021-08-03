<?php
    $conexion = mysqli_connect("localhost", "root", "", "proyecto2020");
    if(!$conexion){
        die("Hubo un error inesperado en la conexión con la base de datos:" . mysqli_error($conexion));
    }
?>