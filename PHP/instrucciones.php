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

  $strSQL = "SELECT * FROM tbrecetas";
  $query = mysqli_query($conexion, $strSQL);
  $recetas = mysqli_fetch_all($query, MYSQLI_ASSOC);

  $strSQL = "SELECT * FROM tbingredientesenreceta";
  $query = mysqli_query($conexion, $strSQL);
  $ingredientes = mysqli_fetch_all($query, MYSQLI_ASSOC);

  $strSQL = "SELECT * FROM tbingredientes";
  $query = mysqli_query($conexion, $strSQL);
  $unidades = mysqli_fetch_all($query, MYSQLI_ASSOC);


  $encontrados = array();
  

  for ($a=0; $a < count($recetas); $a++) { 
    $buscar = $recetas[$a]['cnReceta'];
    if(strstr($pedido[0]['cnRecetas'], $buscar)){
        $encontrados[] = array("cnReceta" => $buscar, "cnPosicion" => $a);
    }
  }

  $preparacion = array();

  for ($a=0; $a < count($encontrados); $a++) { 
    $ingredientesNuevo = array();
    $cnReceta = $encontrados[$a]['cnReceta'];
    $cnPreparacion = $recetas[$encontrados[$a]['cnPosicion']]['cnPreparacion'];
    $cnImagen = $recetas[$encontrados[$a]['cnPosicion']]['cnImagen'];
    //poner un array para ingredientes
    for ($b=0; $b < count($ingredientes); $b++) { 
        if($ingredientes[$b]['cnReceta'] == $encontrados[$a]['cnReceta']){
            $ingredientesNuevo[] = array("cnIngrediente" => $ingredientes[$b]['cnIngrediente'], "cnCantidad" => $ingredientes[$b]['cnCantidad']);
        }
    }
    $preparacion[] = array("cnReceta" => $cnReceta, "cnPreparacion" => $cnPreparacion, "cnImagen" => $cnImagen, "ingredientes" => $ingredientesNuevo);
  }

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Instrucciones</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href = '../EXT/fontawesome-free-5.15.1-web/css/all.css' rel="stylesheet">
  <link href="../CSS/style.css" rel = "stylesheet" type="text/css">
</head>
<body>
  <?php include 'nav.php'; ?>
  <?php
    for ($a=0; $a < count($preparacion); $a++) { 
        
    ?>
  <div class = 'pedido_content'>
    <div class = 'row'>
        <div class = 'col-2'>
        </div>
        <div class = 'col-10 img_plato'>
          <img src = '<?php echo $preparacion[$a]['cnImagen']; ?>' width="400px" height="300px" >
          <p class = 'title_plato display-4'><?php echo $preparacion[$a]['cnReceta']; ?></p>
        </div>
        <div class = col-1>
        </div>
        <div class = col-6>
            <pre><?php echo $preparacion[$a]['cnPreparacion'];; ?></pre>
        </div>
        <div class = 'col-1'></div>
        <div class = col-3>
            <ul class = 'list-unstyled'>
                <?php
                    for ($b=0; $b < count($preparacion[$a]['ingredientes']); $b++) { 
                        for ($c=0; $c < count($unidades); $c++) { 
                            if($unidades[$c]['cnIngrediente'] == $preparacion[$a]['ingredientes'][$b]['cnIngrediente']){
                                $unidad = $unidades[$c]['cnUnidad'];
                            }
                        }
                        $print = $preparacion[$a]['ingredientes'][$b]['cnCantidad'] . " " . $unidad . " de " . $preparacion[$a]['ingredientes'][$b]['cnIngrediente'];
                        echo "<li>" . $print . "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
    <?php } ?>

<?php include 'modals-globales.php'; ?>
  <footer></footer>
</body>
</html>