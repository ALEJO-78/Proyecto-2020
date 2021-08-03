<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    ini_set("memory_limit","16M");
    include 'conexion.php';
?>

<head>
  <meta charset="utf-8">
  <title>Home</title>
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
  <h1 class = 'display-1 text-center' style="margin-top: 1em;">Bienvenido a RecipeKart</h1>
  <article class = 'content_steps'>
    <ul class = 'container_steps'>
      <li class = 'steps_list'>
        <i class="fas fa-shopping-cart"></i>
        <span class = 'step_title'>Elegi tu plato</span>
        <span class = 'step_subtitle'>Entre la variedad elecciones.</span>
      </li>
      <li class = 'steps_list'>
        <i class="fas fa-bicycle"></i>
        <span class = 'step_title'>Lo recibis</span>
        <span class = 'step_subtitle'>En la direccion que quieras.</span>
      </li>
      <li class = 'steps_list'>
        <i class="fas fa-pizza-slice"></i>
        <span class = 'step_title'>Lo cocinas</span>
        <span class = 'step_subtitle'>Y disfrutas de un rico plato.</span>
      </li>
    </ul>
  </article>
  <footer></footer>
  <!--MODALS-->
  <?php include 'modals-main.php';?>
  <?php include 'modals-globales.php';?>
</body>
</html>
