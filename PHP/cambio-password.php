<?php
    include 'conexion.php';
    if(!isset($_SESSION['username'])){
        header("Location: main.php");
    }
    $username = $_SESSION['username'];
?>


<?php
    if(isset($_POST['cambiar-password'])){
        $passwordVieja = $_POST['password-vieja'];
        $passwordNueva = $_POST['password-nueva'];
        $passwordNuevaConfirm = $_POST['password-nueva-repetida'];
        $strSQL = "SELECT cnPassword FROM tbusuarios WHERE cnUsername = '$username'";
        $query = mysqli_query($conexion, $strSQL);
        $array = mysqli_fetch_array($query);
        if(password_verify($passwordVieja, $array['cnPassword'])){
            //contraseña correcta
            if($passwordNueva == $passwordNuevaConfirm){
                if(preg_match('/[0-9]/', $passwordNueva) AND preg_match('/[A-Z]/', $passwordNueva) AND preg_match('/[a-z]/', $passwordNueva) AND strlen($passwordNueva) > 8 AND strlen($passwordNueva) < 25){
                    $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
                    $strSQL = "UPDATE tbusuarios SET cnPassword = '$passwordHash' WHERE cnUsername = '$username'";
                    mysqli_query($conexion, $strSQL);
                        
                    
                }
                else{
                    //La contraseña debe contener al menos una letra mayúscula, una minúscula, y un número.
                }
            }
            else{
                //las contraseñas no coinciden
            }
        }
        else{
            //la contraseña coincide con la base
        }
    }
    //header("Location: main.php");
?>
</body>
</html>