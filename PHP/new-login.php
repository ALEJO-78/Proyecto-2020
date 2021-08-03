<?php
    session_start();
    ini_set("memory_limit","16M");
    include 'conexion.php';

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
                header("Location: main.php");
            }
        }
    }

    //registro(cambiar todos los nombres de los post)
    if(isset($_POST['submit-register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password-confirm'];
        $jerarquia = "Cliente";
        $strSQL = "SELECT cnUsername FROM tbusuarios WHERE cnUsername = '$username'";
        $query = mysqli_query($conexion, $strSQL);
        if(mysqli_num_rows($query) == 0 AND strlen($username) > 3 AND strlen($username) < 20){
            //el usuario esta disponible
            if($password == $passwordConfirm){
                //contraseñas ingresadas coinciden
                //hacer que la password sea segura
                if(preg_match('/[0-9]/', $password) AND preg_match('/[A-Z]/', $password) 
                    AND preg_match('/[a-z]/', $password) AND strlen($password) > 8 AND strlen($password) < 25){
                    //se codifica la passwd
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $strSQL = "INSERT INTO tbusuarios(cnUsername, cnPassword, cnJerarquia) 
                    VALUES ('$username', '$passwordHash', '$jerarquia')";
                    mysqli_query($conexion, $strSQL);
                    $_SESSION['username'] = $username;
                    header("Location: main.php");
                }
            } 
        }   
    }
?>