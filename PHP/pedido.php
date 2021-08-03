<!DOCTYPE html>
<html lang="en">
<?php  
  session_start();
  ini_set("memory_limit","16M");
  include 'conexion.php';
  if(!isset($_SESSION['username'])){
    header("Location: main.php");
  }
  if(!isset($_SESSION['carrito'])){
    header("Location: main.php");
  }

  
  
  //include 'login.php';
  //se fija si se marcaron prioridades
  $prioridadPrecio = false;
  $prioridadCantidad = false;
  $prioridadCalidad = false;

  
  $sinPrioridad = true;
  if(isset($_SESSION['prioridad-precio']) AND isset($_SESSION['prioridad-cantidad']) AND isset($_SESSION['prioridad-calidad'])){
    if($_SESSION['prioridad-precio'] == true){
      
      $prioridadPrecio = $_SESSION['prioridad-precio'];
      $sinPrioridad = false;
    }
    else if($_SESSION['prioridad-cantidad'] == true){
      
      $prioridadCantidad = $_SESSION['prioridad-cantidad'];
      $sinPrioridad = false;
    }
    else if($_SESSION['prioridad-calidad'] == true){
      
      $prioridadCalidad = $_SESSION['prioridad-calidad'];
      $sinPrioridad = false;
    }
  }

  $pidio = false;

  if(isset($_POST['submit-comprar'])){
    if(isset($_POST['select-direcciones']) AND $_POST['select-direcciones'] != "sin-direccion"){

      $pidio = true;
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
      //header("Location: pedido.php");
      
      
    }
    else{
        //header("Location: pedido.php");
    }
  }


  //hay que ver como se llena este carrito
  $carrito = $_SESSION['carrito'];
   
  //$carrito = $_SESSION['carrito'];
  for($a=0; $a < count($carrito); $a++){
    $strSQL = "SELECT cnIngrediente, cnCantidad FROM tbingredientesenreceta WHERE cnReceta = '$carrito[$a]'";
    $resultado = mysqli_query($conexion, $strSQL);
    $ingredientes[$a] = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }
  //print_r($ingredientes);
  //echo '</br> </br>'; 

  //sumar todos los ingredientes
  $ingredientesTotales = array();
  $repetido = false;
  for($a=0; $a < count($carrito); $a++){
    for($b=0; $b < count($ingredientes[$a]); $b++){
      //si existe no se agrega y se suma
      $repetido = false;
      for($c=0; $c < count($ingredientesTotales); $c++){ 
        if($ingredientesTotales[$c]['cnIngrediente'] == $ingredientes[$a][$b]['cnIngrediente']){
          $cantidadSumada = $ingredientesTotales[$c]['cnCantidad'] + $ingredientes[$a][$b]['cnCantidad'];
          $ingredientesTotales[$c] = array("cnIngrediente" => $ingredientesTotales[$c]['cnIngrediente'], "cnCantidad" => $cantidadSumada);
          $repetido = true;
        }
      }
      if(!$repetido){
        $ingredientesTotales[] = $ingredientes[$a][$b];
      }
    }
  }
  //print_r($ingredientesTotales);
  //echo '</br> </br>'; 

  //esto es para que el programa decida que productos son mas convenientes
  if(!$sinPrioridad){
    $productosFinales = array();
    for($a=0; $a < count($ingredientesTotales); $a++){ 
      $ingrediente = $ingredientesTotales[$a]['cnIngrediente'];
      $cantidad = $ingredientesTotales[$a]['cnCantidad'];
      $strSQL = "SELECT *, 
      CEILING('$cantidad'/cnCantidad) as cnCantidadCompra, 
      CEILING('$cantidad'/cnCantidad) * cnPrecio as cnPrecioCompra, 
      CEILING('$cantidad'/cnCantidad) * cnCantidad - '$cantidad' as cnSobranteCompra 
      FROM tbproductos 
      WHERE cnIngrediente = '$ingrediente' AND cnStock = \"Si\" 
      order by ";
      if($prioridadCalidad){
        $strSQL = $strSQL . "cnCalidad desc, cnSobranteCompra asc, cnPrecioCompra asc";
      }
      else if($prioridadCantidad){
        $strSQL = $strSQL . "cnSobranteCompra asc, cnCalidad desc, cnPrecioCompra asc";
      }
      else if($prioridadPrecio){
        $strSQL = $strSQL . "cnPrecioCompra asc, cnCalidad desc, cnSobranteCompra asc";
      }
      $query = mysqli_query($conexion, $strSQL);
      $resultado = mysqli_fetch_all($query, MYSQLI_ASSOC);
      //esto limpia los productos que no se van a pedir(las peores opciones), al pedir solo la columna 1
      $productosFinales[] = $resultado[0];

    }
  
    //print_r($productosFinales);
  //direcciones para mostrar en el select
  $username = $_SESSION['username'];
  $strSQL = "SELECT cnUsername, cnDireccion1, cnDireccion2, cnDireccion3 FROM tbusuarios WHERE cnUsername = '$username'";
  $query = mysqli_query($conexion, $strSQL);
  $direcciones = mysqli_fetch_all($query);

  //es cosmetico, para mostrar en que unidad es cada ingrediente
  $strSQL = "SELECT * FROM tbingredientes";
  $query = mysqli_query($conexion, $strSQL);
  $unidadesIngredientes = mysqli_fetch_all($query);
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

  <form action="seleccion-prioridades.php" method="post">
    <div class = 'row'>
      
        <div class = 'col-3'>
          <p class = 'opcion'>Opcion premium</p>
          <button type='submit' name='prioridad-calidad' class = 'btn btn-dark ag_carrito'>Seleccionar</button>
        </div>

        <div class = 'col-3'>
          <p class = 'opcion'>Opcion económica</p>
          <button type='submit' name='prioridad-precio' class = 'btn btn-dark ag_carrito'>Seleccionar</button>
        </div>

        <div class = 'col-3'>
          <p class = 'opcion'>Opcion menor sobrante</p>
          <button type='submit' name='prioridad-cantidad' class = 'btn btn-dark ag_carrito'>Seleccionar</button>
        </div>
      
    </div>
  </form>  
  
  <?php if(!$sinPrioridad){?>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Mi carrito</span>
        <span class="badge badge-secondary badge-pill"><?php echo count($carrito)?></span>
      </h4>
      <ul class="list-group mb-3">
        <?php
          $repetido = array();
          for($a=0; $a < count($carrito); $a++){
            
            $repe = 0;
            for($b=0; $b < count($carrito); $b++){ 
              if($carrito[$a] == $carrito[$b]){
                $repe++;
              }
            }
            $unico = true;
            if(count($repetido) > 0){
              for($c=0; $c < count($repetido); $c++){ 
                if($repetido[$c]['receta'] == $carrito[$a]){
                  $unico = false;
                }
              }
            }
 
            if($unico){
              $repetido[] = array("receta" => $carrito[$a], "repetido" => $repe);
            
            ?>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0"><?php echo $repetido[count($repetido) - 1]['receta'] . " x" . $repetido[count($repetido) - 1]['repetido'] ?></h6>
                </div>
              </li>
            <?php
            }
          }
          $_SESSION['cnRecetas'] = $repetido;
        ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (ARS)</span>
          <strong><?php
            $precio = 0;
            for ($a=0; $a < count($productosFinales); $a++) { 
              $precio = $precio + $productosFinales[$a]['cnPrecioCompra'];
            }
            echo "$" . $precio;
            $_SESSION['cnPrecio'] = $precio;
          ?></strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Ingredientes incluidos en tu pedido</h4>
      <div class = 'ingredientes_carrito'>
      <?php
        $productos = array();
        for($a=0; $a < count($productosFinales); $a++){ 
          ?>
            <ul class = 'carrito_content'>
              <li><?php //tiene marca
              $tieneMarca = false;
              $ingrediente = $productosFinales[$a]['cnIngrediente'];
              $marca = $productosFinales[$a]['cnMarca'];
              $cantidad = $productosFinales[$a]['cnCantidad'];
              $cantidadCompra = $productosFinales[$a]['cnCantidadCompra'];
              $strSQL = "SELECT cnUnidad FROM tbingredientes WHERE cnIngrediente = '$ingrediente'";
              $query = mysqli_query($conexion, $strSQL);
              $array = mysqli_fetch_all($query);
              $unidad = $array[0][0];
              $unaUnidad = false;

              //precio
              $strSQL = "SELECT cnPrecio FROM tbproductos WHERE cnIngrediente = '$ingrediente' AND cnMarca = '$marca' AND cnCantidad = '$cantidad'";
              $query = mysqli_query($conexion, $strSQL);
              $precio = mysqli_fetch_all($query, MYSQLI_ASSOC);

              if($cantidad == 1 AND $unidad == "unidades"){
                $unaUnidad = true;
              }
              if($productosFinales[$a]['cnMarca'] != "-"){
                $tieneMarca = true;
              }
              $print = $ingrediente;
              if($tieneMarca){
                $print = $print . " " . $marca;
              }
              if(!$unaUnidad){
                $print = $print . " " . $cantidad;
              }
              if($unidad != "unidades"){
                $print = $print . " " . $unidad;
              }
              else if(!$unaUnidad){
                $print = $print . " " . $unidad;
              }
              $print = $print . " x " . $cantidadCompra . "   $" . $precio[0]['cnPrecio'] . " c/u";
              echo $print;

              $productos[] = $print . ", "

              //echo $ingrediente . " " . $marca . " " . $cantidad . " " . $unidad . " x " . $cantidadCompra;
              ?></li>
            </ul>
          <?php
        }
        $_SESSION['cnPedido'] = $productos;
      ?>
      </div>
        <div class="row direccion_entrega">
          <div class="col-md-5 mb-3">
            <label for="direccion">Direccion de entrega</label>
          <form action="pedido.php" method="post">
              <select name="select-direcciones" class="custom-select d-block w-100" id="direccion" required>
                <option name="sin-direccion" value="sin-direccion">Elegir direccion</option>
                <?php
                  for($a=0; $a < count($direcciones); $a++){
                    $dirNum = 0;
                    for($b=0; $b < count($direcciones[$a]); $b++){ 
                      if($direcciones[0][$b] != "" AND $direcciones[0][$b] != $username){
                          
                          $dirNum++;
                          $name = "dir" . $dirNum;
                          $direccion = $direcciones[$a][$b];
                        ?>
                        <option <?php echo "name=\"$name\""; echo "value\"$direccion\""?>><?php echo $direcciones[$a][$b] ?></option>
                        <?php
                      }
                    }
                  }
                ?>
              </select>
            
          
      
        <button name="submit-comprar" class="btn btn-lg btn-block confirm_pedido" type="submit" style="background-color: #343a40;color: white;margin-bottom: 4em;">Comprar</button>
        </form>
      </div>
    </div>
  </div>
  </div>
  <?php }?>
  <footer></footer>

  <!--MODALS-->
  <?php include 'modals-globales.php';?>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    let btnConfirm = document.querySelector('.confirm_pedido');

    btnConfirm.addEventListener('click', () => {
      swal({
        title:'Pedido confirmado',
        text:'Entra a tus pedidos para ver el estado.',
        icon:'success',
        timer:1000,
        button:{
          className:'btn btn-lg btn-block alert-btn',
        },
      });
    });
  </script>

  <?php
    if($pidio){
      ?>
      <script>
        swal({
        title:'Pedido confirmado',
        text:'Entra a tus pedidos para ver el estado.',
        icon:'success',
        timer:1000,
        button:{
          className:'btn btn-lg btn-block alert-btn',
        },
      });
      </script>
      <?php
    }
  ?>
</body>
</html>