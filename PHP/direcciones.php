<?php
    include 'conexion.php';
    $username = $_SESSION['username'];
    $strSQL = "SELECT cnDireccion1, cnDireccion2, cnDireccion3 FROM tbusuarios WHERE cnUsername = '$username'";
    $query = mysqli_query($conexion, $strSQL);
    $direccionesArray = mysqli_fetch_array($query);
    $dir1Set = false;
    $dir2Set = false;
    $dir3Set = false;
    if($direccionesArray['cnDireccion1'] != ""){
        $dir1Set = true;
    }
    if($direccionesArray['cnDireccion2'] != ""){
        $dir2Set = true;
    }
    if($direccionesArray['cnDireccion3'] != ""){
        $dir3Set = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="../CSS/style.css" rel = "stylesheet" type="text/css">
</head>
<body>
    <div class = "nav">
        <nav class="navbar navbar-expand-lg navbar-transparent sticky-top" id='navbar_top'>
            <a class="navbar-brand" href="#" id = "nav-text">Nombre</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="main.html" id = "nav-text">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" id = "nav-text">Pedi ahora!</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#"  id = "nav-text" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#" id = "nav-text">Mi carrito</a>
                    <a class="dropdown-item" href="#" id = "nav-text">Mis pedidos</a>
                    <a class="dropdown-item " href="direcciones.html" id = "nav-text">Mis direcciones</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cambiopassword.html" id = "nav-text" >Cambiar contraseña</a>
                  </div>
                </li>
              </ul>
            </div>
        </nav>
      </div>
      <div class = 'form-direcciones'>
        <div class = 'form'>
            <form action="direcciones.php" method="post" class="address-form">
                <p style ="font-size: 18px;font-family: Arial, Helvetica, sans-serif;font-weight: 500;">Mis direcciones</p>
                <?php 
                    if($dir1Set == true){
                        $dir1 = $direccionesArray['cnDireccion1'];
                        ?>
                        <input name="dir1" type="address" placeholder="<?php echo "$dir1"; ?>"/>
                        <?php
                    }else{
                        echo '<input name="dir1" type="address" placeholder="Direccion N°1"/>';
                    }

                    if($dir2Set == true){
                        $dir2 = $direccionesArray['cnDireccion2'];
                        ?>
                        <input name="dir2" type="address" placeholder="<?php echo "$dir2"; ?>"/>
                        <?php
                    }else{
                        echo '<input name="dir2" type="address" placeholder="Direccion N°2"/>';
                    }

                    if($dir3Set == true){
                        $dir3 = $direccionesArray['cnDireccion3'];
                        ?>
                        <input name="dir3" type="address" placeholder="<?php echo "$dir3"; ?>"/>
                        <?php
                    }else{
                        echo '<input name="dir3" type="address" placeholder="Direccion N°3"/>';
                    }
                ?> 
                <p style ="color: red;font-size: 12px;display: none;visibility: hidden;">Direccion N° <!--numero direccion--> no existe.</p>
                <button name="submit-direcciones" type="submit">Guardar cambios</button>
            </form>
          </div>
      </div>
</body>

</html>

<?php
    if(isset($_POST['submit-direcciones'])){
        $dir1 = $_POST['dir1'];
        $dir2 = $_POST['dir2'];
        $dir3 = $_POST['dir3'];
        $username = $_SESSION['username'];
        if($dir1 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion1 = '$dir1' WHERE cnUsername = '$username'";
            if(mysqli_query($conexion, $strSQL)){
                //redirigir a home
            }
        }
        if($dir2 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion2 = '$dir2' WHERE cnUsername = '$username'";
            if(mysqli_query($conexion, $strSQL)){
                //redirigir a home
            }
        }
        if($dir3 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion3 = '$dir3' WHERE cnUsername = '$username'";
            if(mysqli_query($conexion, $strSQL)){
                //redirigir a home
            }
        }
    }
?>