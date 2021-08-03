<?php
    session_start();
    ini_set("memory_limit","16M");
    include 'conexion.php';
    if(isset($_POST['submit-direcciones'])){
        $dir1 = $_POST['dir1'];
        $dir2 = $_POST['dir2'];
        $dir3 = $_POST['dir3'];
        $username = $_SESSION['username'];
        if($dir1 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion1 = '$dir1' WHERE cnUsername = '$username'";
            mysqli_query($conexion, $strSQL);
        }
        if($dir2 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion2 = '$dir2' WHERE cnUsername = '$username'";
            mysqli_query($conexion, $strSQL);
        }
        if($dir3 != ""){
            $strSQL = "UPDATE tbusuarios SET cnDireccion3 = '$dir3' WHERE cnUsername = '$username'";
            mysqli_query($conexion, $strSQL);
        }
    }
    header("Location: main.php");
?>