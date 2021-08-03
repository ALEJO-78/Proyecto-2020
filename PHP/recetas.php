<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  ini_set("memory_limit","16M");
  include 'conexion.php';
  if(!isset($_SESSION['username'])){
    header("Location: main.php");
  }

  $strSQL = "SELECT * FROM tbrecetas";
  $query = mysqli_query($conexion, $strSQL);
  $recetas = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $_SESSION['recetas'] = $recetas;
  
  
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

    <form action="seleccion-prioridades.php" method="post">
  <?php
    for ($a=0; $a < count($recetas); $a++) {
      $receta = $recetas[$a]['cnReceta'];
      
      //se ven cuales ingredientes son necesarios para armar la receta en cuestión
      $strSQL = "SELECT cnIngrediente FROM tbingredientesenreceta WHERE cnReceta = '$receta'";
      $query = mysqli_query($conexion, $strSQL);
      $ingredientesNecesarios[$receta] = mysqli_fetch_all($query, MYSQLI_ASSOC);

      //se ve de cuales productos disponemos para cubrir todos los ingredientes
      for ($b=0; $b < count($ingredientesNecesarios[$receta]); $b++) {
        $ingrediente = $ingredientesNecesarios[$receta][$b]['cnIngrediente'];
        $strSQL = "SELECT cnIngrediente FROM tbproductos WHERE cnIngrediente = '$ingrediente' AND cnStock = \"Si\"";
        $query = mysqli_query($conexion, $strSQL);
        $IngredientesDisponibles[$receta][] = mysqli_fetch_array($query, MYSQLI_ASSOC);
      }
      
      $stock = true;
      //vemos si todos los ingredientes pueden ser obtenidos
      for ($c=0; $c < count($ingredientesNecesarios[$receta]); $c++) { 
        if(!in_array($ingredientesNecesarios[$receta][$c], $IngredientesDisponibles[$receta])){
          $stock = false;
        }
      }
      
      //si no hay stock de algo, no se muestra en las opciones de pedir
      if($stock){
      ?>
        <div class = 'row'>
          <div class = 'col-12 img_plato'>
            <img src = "<?php echo $recetas[$a]['cnImagen']; ?>" width="400px" height="300px" >
            <p class = 'title_plato display-4'><?php echo $receta; ?></p>
          </div>
          <div class = 'col-5'></div>
            <div class = 'col-4'>
              <button type = 'submit' <?php echo "name=\"$a\"";?> class ='btn btn-dark ag_carrito'>Agregar al carrito</button>
              <!--<p class = 'precio'>Desde: $</p>-->
            </div>
        </div>
        <hr></hr>
    <?php 
    }
  }
    ?>
    </form>

  <!--MODALS-->
  <?php include 'modals-globales.php';?>
  <footer></footer>
</body>
</html>