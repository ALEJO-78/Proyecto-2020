<html>
<?php
    include 'conexion.php';
    session_start();
    $strSQL = "SELECT * FROM tbrecetas";
    $resultado = mysqli_query($conexion, $strSQL);
    $recetas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    //aca se cargan las recetas
    for($a=0; $a < count($recetas); $a++){ 
        
    }
    $carrito = array();
    $_SESSION['carrito'] = $carrito;
?>
</html>