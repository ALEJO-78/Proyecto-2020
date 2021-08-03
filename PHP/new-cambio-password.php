<?php
    session_start();
    include 'conexion.php';
    if(!isset($_SESSION['username'])){
        header("Location: main.php");
    }
    

    if(isset($_POST['cambiar-password'])){
        $username = $_SESSION['username'];
        $passwordVieja = $_POST['password-vieja'];
        $passwordNueva = $_POST['password-nueva'];
        $passwordNuevaConfirm = $_POST['password-nueva-repetida'];
        $strSQL = "SELECT cnPassword FROM tbusuarios WHERE cnUsername = '$username'";
        $query = mysqli_query($conexion, $strSQL);
        $passwd = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if(password_verify($passwordVieja, $passwd[0]['cnPassword'])){
            //contraseña correcta
            if($passwordNueva == $passwordNuevaConfirm){
                if(preg_match('/[0-9]/', $passwordNueva) AND preg_match('/[A-Z]/', $passwordNueva) 
                    AND preg_match('/[a-z]/', $passwordNueva) 
                    AND strlen($passwordNueva) > 8 AND strlen($passwordNueva) < 25){
                    $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
                    $strSQL = "UPDATE tbusuarios SET cnPassword = '$passwordHash' WHERE cnUsername = '$username'";
                    mysqli_query($conexion, $strSQL);
                }
            }
        }
    }
    header("Location: main.php");
?>