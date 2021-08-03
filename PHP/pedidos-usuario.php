<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  ini_set("memory_limit","16M");
  include 'conexion.php';
  if(!isset($_SESSION['username'])){
    header("Location: main.php");
  }

  $username = $_SESSION['username'];
  $strSQL = "SELECT * FROM tbpedidos WHERE cnCliente = '$username' ORDER BY cnID DESC";
  $query = mysqli_query($conexion, $strSQL);
  $pedidos = mysqli_fetch_all($query, MYSQLI_ASSOC);
  if(count($pedidos) == 0){
    header("Location: main.php");
  }

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href = '../EXT/fontawesome-free-5.15.1-web/css/all.css' rel="stylesheet">
  <link href="../CSS/style.css" rel = "stylesheet" type="text/css">
</head>
<body>
  <?php include 'nav.php';?>
  <?php 
    for($a=0; $a < count($pedidos); $a++){ 

      ?> 
    
  
  <div class = 'pedido_content'>
    <h1 class = 'pedido_num display-4'>ID: <?php echo $pedidos[$a]['cnID']; ?></h1>
    <ul class = 'pedido_platos list-unstyled'>
      <Li>Pediste: <?php echo $pedidos[$a]['cnRecetas']; ?></Li>
      <Li>Opción: <?php echo $pedidos[$a]['cnOpcion']; ?></Li>
      <form action="instrucciones.php" method="post">
        <button type = 'submit' name="id" <?php echo "value=\"" . $pedidos[$a]['cnID'] . "\"";?> class ='btn btn-dark ag_carrito'>Ver receta para la preparación</button>
      </form>
    </ul>
    <p class = 'info_pedido'>Día y Horario: <?php echo $pedidos[$a]['cnHorario']; ?></p>
    <p class = 'info_pedido'>Precio: <?php echo "$" . $pedidos[$a]['cnPrecio']; ?></p>
    <p class = 'info_pedido'>Direccion: <?php echo $pedidos[$a]['cnDireccion']; ?></p>
    <p class = 'info_pedido'>Estado: <?php echo $pedidos[$a]['cnEstado']; ?></p>
    <p></p>
  </div>
  <?php
    }
  ?>
    <!--MODALS-->
    <?php include 'modals-globales.php';?>
    <footer></footer>
</body>
</html>