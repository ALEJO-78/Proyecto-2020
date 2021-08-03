<!DOCTYPE html>
<html lang = "en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../EXT/materialize/css/materialize.css"  media="screen,projection"/>
    <link href="../CSS/style.css" rel = "stylesheet" type="text/css">
    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
</head>
<body>
  <div class="login-page">
    <div class="form">
    
        <form action="login.php" method="post" class="register-form">
            <input name="username" type="text" placeholder="Usuario"/>
            <input name="password" type="Password" placeholder="Contraseña"/>
            <input name="password-confirm" type="Password" placeholder="Confirmar contraseña"/>
            <p class="usuario-existe" style ="color: red;font-size: 12px;display: none;">El usuario ya existe o no es de entre 3 y 20 caracteres.</p>
            <p class="password-distintos" style ="color: red;font-size: 12px;display: none;">Las contraseñas ingresadas no coinciden.</p>
            <p class="password-invalido" style ="color: red;font-size: 12px;display: none;">La contraseña debe tener una letra mayúscula, minúscula, y un número.</p>
            <button name="submit-register" type="submit">Registrarse</button>
        <p class="message">¿Ya estas registrado? <a href="#">Iniciar sesion</a></p>
        </form>
    
    
        <form action="login.php" method="post" class="login-form">
            <input name="username" type="text" placeholder="Usuario"/>
            <input name="password" type="Password" placeholder="Contraseña"/>
            <p class="login-incorrecto" style ="color: red;font-size: 12px;display: none;">Usuario y contraseña no coinciden</p>
            <button name="submit-login" type="submit">Iniciar sesion</button>
        <p class="message">¿No estas registrado? <a href="#">Registrarse</a></p>
        </form>
    
    </div>
    </div>
    <script>
      $('.message a').click(function(){
      $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
      });
      $("p.login-incorrecto").hide();
      $("p.usuario-existe").hide();
      $("p.password-distintos").hide();
      $("p.password-invalido").hide();
    </script>
    


<?php
    $conexion = mysqli_connect("localhost", "root", "%Project2020%APLMBE", "proyecto2020");
    if(!$conexion){
        die("Hubo un error inesperado en la conexión con la base de datos:" . mysqli_error($conexion));
    }
    session_start();
    
    //se hace el form de login
    if(isset($_POST['submit-login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $strSQL = "SELECT cnUsername, cnPassword FROM tbusuarios WHERE cnUsername = '$username'";
        $query = mysqli_query($conexion, $strSQL);
        if(mysqli_num_rows($query) != 0 AND $array = mysqli_fetch_array($query)){
            //el usuario existe, asi que ahora se comprobará la passwd
            $passwordHash = $array['cnPassword'];
            if(password_verify($password, $passwordHash)){
                //el usuario se logueó correctamente
                $_SESSION['username'] = $username;
                header("Location: direcciones.php");
            }
            else{
                //msj de error
                ?><script>$("p.login-incorrecto").show();</script><?php
            }
        }
        else if($username != ""){
            //msj error
            ?><script>$("p.login-incorrecto").show();</script><?php
        }
    }

    //registro(cambiar todos los nombres de los post)
    if(isset($_POST['submit-register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password-confirm'];
        $direccion = "INDEFINIDA";
        $jerarquia = "Cliente";
        $strSQL = "SELECT cnUsername FROM tbusuarios WHERE cnUsername = '$username'";
        $query = mysqli_query($conexion, $strSQL);
        if(mysqli_num_rows($query) == 0 AND strlen($username) > 3 AND strlen($username) < 20){
            //el usuario esta disponible
            if($password == $passwordConfirm){
                //contraseñas ingresadas coinciden
                //hacer que sean seguras
                if(preg_match('/[0-9]/', $password) AND preg_match('/[A-Z]/', $password) AND preg_match('/[a-z]/', $password) AND strlen($password) > 8 AND strlen($password) < 25){
                    //se codifica la passwd
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $strSQL = "INSERT INTO tbusuarios(cnUsername, cnPassword, cnJerarquia) 
                    VALUES ('$username', '$passwordHash', '$jerarquia')";
                    if(mysqli_query($conexion, $strSQL)){
                        //el usuario se registro correctamente, redirigir a home
                        echo "el usuario se registro correctamente, redirigir a home";
                        $_SESSION['username'] = $username;
                        header("Location: direcciones.php");
                    }
                    else{
                        //ocurrió un error inesperado en el registro del usuario, recargue la página e intente de nuevo
                        
                    }
                }
                else{
                    //La contraseña debe contener al menos una letra mayúscula, una minúscula, y un número.
                    ?><script>$("p.password-invalido").show();</script><?php
                }
            }
            else{
                //Las contraseñas ingresadas no coinciden.
                ?><script>$("p.password-distintos").show();</script><?php
            }
        }
        else{
            //El usuario ya existe o no es de entre 3 y 20 caracteres.
            ?><script>$("p.usuario-existe").show();</script><?php
        }
    }
?>
</body>
</html>