<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    ini_set("memory_limit","16M");
    include 'conexion.php';
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    if(isset($_POST['prioridad-cantidad'])){
        $_SESSION['prioridad-cantidad'] = true;
        $_SESSION['prioridad-precio'] = false;
        $_SESSION['prioridad-calidad'] = false;
        //echo "cantidad";
        header("Location: pedido.php");
    }
    else if(isset($_POST['prioridad-precio'])){
        $_SESSION['prioridad-precio'] = true;
        $_SESSION['prioridad-cantidad'] = false;
        $_SESSION['prioridad-calidad'] = false;
        //echo "precio";
        header("Location: pedido.php");
    }
    else if(isset($_POST['prioridad-calidad'])){
        $_SESSION['prioridad-calidad'] = true;
        $_SESSION['prioridad-cantidad'] = false;
        $_SESSION['prioridad-precio'] = false;
        //echo "calidad";
        header("Location: pedido.php");
    }

    //recetas.php
    $recetas = $_SESSION['recetas'];
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = array();
    }
    for ($a=0; $a < count($recetas); $a++) {
        if(isset($_POST[$a])){
            $_SESSION['carrito'][] = $recetas[$a]['cnReceta'];
            header("Location: pedido.php");
        }
    }
 

    //pedido.php comprar
    if(isset($_POST['submit-comprar'])){
        if(isset($_POST['select-direcciones']) AND $_POST['select-direcciones'] != "sin-direccion"){
          //ingresó direccion
          $strSQL = "SELECT * FROM tbpedidos";
          $query = mysqli_query($conexion, $strSQL);
          $pedidos = mysqli_fetch_all($query, MYSQLI_ASSOC);

          $cnID = count($pedidos) + 1;
          $cnCliente = $_SESSION['username'];
          $cnRecetas = "";
          for ($a=0; $a < count($_SESSION['cnRecetas']); $a++) { 
            if($cnRecetas == ""){
                $cnRecetas = $_SESSION['cnRecetas'][$a]['receta'] . "x " . $_SESSION['cnRecetas'][$a]['repetido'];
            }
            else{
                $cnRecetas = $cnRecetas . ", " . $_SESSION['cnRecetas'][$a]['receta'] . "x " . $_SESSION['cnRecetas'][$a]['repetido'];
            }
          }
          
          $cnPedido = "";
          for($a=0; $a < count($_SESSION['cnPedido']); $a++){
            $cnPedido = $cnPedido . $_SESSION['cnPedido'][$a];
          }

          if($_SESSION['prioridad-precio'] == true){
      
            $cnOpcion = "Económico";
          }
          else if($_SESSION['prioridad-cantidad'] == true){
            
            $cnOpcion = "Menor Sobrante";
          }
          else if($_SESSION['prioridad-calidad'] == true){
            
            $cnOpcion = "Premium";
          }
          
          $cnPrecio = $_SESSION['cnPrecio'];
          //antes de hacer submit hacer lo de las llaves primarias en la db

          $cnDireccion = $_POST['select-direcciones'];

          $time = time();
          $cnHorario = date("d-m-Y (H:i:s)", $time);

          $cnEstado = "Pendiente";

          $strSQL = "INSERT INTO tbpedidos (cnID, cnCliente, cnRecetas, cnPedido, cnOpcion, cnPrecio, cnDireccion, cnHorario, cnEstado) 
          VALUES ('$cnID', '$cnCliente', '$cnRecetas', '$cnPedido', '$cnOpcion', '$cnPrecio', '$cnDireccion', '$cnHorario', '$cnEstado')";

          mysqli_query($conexion, $strSQL);
          header("Location: main.php");
          
          
        }
        else{
            header("Location: pedido.php");
        }
    }
?>
</html>