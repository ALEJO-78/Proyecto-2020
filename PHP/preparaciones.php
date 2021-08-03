<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  ini_set("memory_limit","16M");
  include 'conexion.php';
  if(!isset($_SESSION['username'])){
    header("Location: main.php");
  }

  //logica para ver que pidio
  $id = $_POST['id'];
  $strSQL = "SELECT cnRecetas FROM tbpedidos WHERE cnID = '$id'";
  $query = mysqli_query($conexion, $strSQL);
  $pedido = mysqli_fetch_all($query, MYSQLI_ASSOC);

  $strSQL = "SELECT cnReceta, cnPreparacion FROM tbrecetas";
  $query = mysqli_query($conexion, $strSQL);
  $recetas = mysqli_fetch_all($query, MYSQLI_ASSOC);

  $strSQL = "SELECT * FROM tbingredientesenreceta";
  $query = mysqli_query($conexion, $strSQL);
  $ingredientes = mysqli_fetch_all($query, MYSQLI_ASSOC);

  print_r($ingredientes);

  $encontrados = array();

  for ($a=0; $a < count($recetas); $a++) { 
    $buscar = $recetas[$a]['cnReceta'];
    if(strstr($pedido[0]['cnRecetas'], $buscar)){
        $encontrados[] = $a;
    }
  }

  for ($a=0; $a < count($encontrados); $a++) { 
    echo $recetas[$encontrados[$a]]['cnReceta'];
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
    for ($a=0; $a < count($encontrados); $a++){ 
      ?> 
    
  
  <div class = 'pedido_content'>
    <ul class = 'pedido_platos list-unstyled'>
      <Li>Receta: <?php echo $recetas[$encontrados[$a]]['cnReceta']; ?></Li>
      <Li>Preparación: <?php echo $recetas[$encontrados[$a]]['cnPreparacion']; ?></Li>
      <?php
        
      ?>
      
    </ul>
  </div>
  <?php
    }
  ?>
    <!--MODALS-->
    <?php include 'modals-globales.php';?>
    </br>
    </br>
    </br>
    </br>
    <footer></footer>
</body>
</html>