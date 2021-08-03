<<?php
include 'conexion.php';
session_start();
$strSQL = "SELECT * FROM tbproductos";
$resultado = mysqli_query($conexion, $strSQL);
$productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
//aca se cargan los productos

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Monitorear stock</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link href = '../EXT/fontawesome-free-5.15.1-web/css/all.css' rel="stylesheet">
   <link href="../CSS/style.css" rel = "stylesheet" type="text/css">
   <link rel="icon" type="image/png" href="../IMG/logo.png"/>
 </head>
 <body>
   <header>
     <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
       <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
           <ul class="navbar-nav mr-auto">
               <li class="nav-item">
                   <a class="nav-link" href="monit_stock.html">Monitorear stock</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="pedidos_ven.html">Ver pedidos</a>
               </li>
           </ul>
       </div>
       <div class="mx-auto order-0">
         <a class="navbar-brand mx-auto" href="home_vendedor.html"><img src = '../IMG/logo.png' width="100px" height="80px"></a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
               <span class="navbar-toggler-icon"></span>
           </button>
       </div>
       <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
           <ul class="navbar-nav ml-auto">
             <li class="nav-item dropdown dropleft">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Mi cuenta
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a class="nav-link " data-toggle="modal" data-target="#modalContraseñas" style = 'color: black;'>Cambiar contraseña</a>
               </div>
             </li>
           </ul>
       </div>
     </nav>
   </header>
   <div class = 'row'>
     <?php
     for($a=0; $a < count($productos); $a++){
     



      ?>
      <form action="cambiar-producto.php" method="post">
  <div class = 'row'>
    <div class = 'col-12' style="left: 30%;">
      <h1 class = 'display-4 title_ing'>HOLA<?php echo $productos[$a]['cnIngrediente'] . " " . $productos[$a]['cnMarca'] . " " . $productos[$a]['cnCantidad'] . " $" . $productos[$a]['cnPrecio']; ?></h1>
      <div class="input-group w-25" style = 'margin-left: 5em;'>
        <div class="input-group-prepend">
          <span class="input-group-text">Precio</span>
        </div>
        <input type="text" name="precio" class="form-control w-25" aria-label="Amount">
        <div class="input-group-append">
          <span class="input-group-text">ARS</span>
        </div>
      </div>
      <button type = 'submit' name="submit-monitorear" class = 'btn btn-dark confirm_ing'>Confirmar precio</button>
      <div>
        <label class="form-check-label" for="stock_dis" style="margin-left: 12em;margin-bottom: 0.25em;">Falta stock</label>
        <input type="checkbox" name="stock" class="form-check-input" id="stock_dis">
      </div>
    </div>
  </div>
  <?php
  }




   ?>
  </form>
   </div>
   <hr>
   <footer></footer>

   <!--MODALS-->
   <div class="modal fade" id="modalContraseñas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header text-center">
             <h4 class="modal-title w-100 font-weight-bold">Cambiar contraseña</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body mx-3">
             <div class="md-form mb-5">
               <i class="fas fa-lock prefix grey-text"></i>
               <input type="text" id="orangeForm-name" class="form-control validate">
               <label data-error="wrong" data-success="right" for="orangeForm-name">Contraseña antigua</label>
             </div>
             <div class="md-form mb-5">
               <i class="fas fa-lock prefix grey-text"></i>
               <input type="email" id="orangeForm-email" class="form-control validate">
               <label data-error="wrong" data-success="right" for="orangeForm-email">Contraseña nueva</label>
             </div>

             <div class="md-form mb-4">
               <i class="fas fa-lock prefix grey-text"></i>
               <input type="password" id="orangeForm-pass" class="form-control validate">
               <label data-error="wrong" data-success="right" for="orangeForm-pass">Repetir contraseña nueva</label>
             </div>
             <div class="modal-footer d-flex justify-content-center">
               <button class="btn btn-deep-orange">Guardar cambio</button>
             </div>
           </div>

         </div>
       </div>
   </div>
 </body>
 </html>
