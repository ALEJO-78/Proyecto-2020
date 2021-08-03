<?php
    include 'conexion.php';
?>

<form action="new-cambio-password.php" method="post">
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
                <input type="password" name="password-vieja" id="orangeForm-name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Contraseña antigua</label>
                </div>
                <div class="md-form mb-5">
                <i class="fas fa-lock prefix grey-text"></i>
                <input type="password" name="password-nueva" id="orangeForm-email" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Contraseña nueva</label>
                </div>

                <div class="md-form mb-4">
                <i class="fas fa-lock prefix grey-text"></i>
                <input type="password" name="password-nueva-repetida" id="orangeForm-pass" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Repetir contraseña nueva</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="cambiar-password" class="btn btn-deep-orange">Guardar cambio</button>
            </div>
            </div>
        </div>
    </div>
</form>
<form action="new-direcciones.php" method="post">
    <div class="modal fade" id="modalDirecciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Mis direcciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                if(isset($_SESSION['username'])){
                    $userame = $_SESSION['username'];
                    $strSQL = "SELECT cnDireccion1, cnDireccion2, cnDireccion3 FROM tbusuarios WHERE cnUsername = '$userame'";
                    $query = mysqli_query($conexion, $strSQL);
                    $direcciones = mysqli_fetch_all($query, MYSQLI_ASSOC);
                }
            ?>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                <i class="fas fa-map-marked-alt prefix grey-text"></i>
                <input type="text" name="dir1" id="orangeForm-name" class="form-control validate" placeholder="<?php echo $direcciones[0]['cnDireccion1']; ?>">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Direccion 1</label>
                </div>
                <div class="md-form mb-5">
                <i class="fas fa-map-marked-alt prefix grey-text"></i>
                <input type="text" name="dir2" id="orangeForm-email" class="form-control validate" placeholder="<?php echo $direcciones[0]['cnDireccion2']; ?>">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Direccion 2</label>
                </div>

                <div class="md-form mb-4">
                <i class="fas fa-map-marked-alt prefix grey-text"></i>
                <input type="text" name="dir3" id="orangeForm-pass" class="form-control validate" placeholder="<?php echo $direcciones[0]['cnDireccion3']; ?>">
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Direccion 3</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="submit-direcciones" class="btn btn-deep-orange">Guardar cambio</button>
            </div>
            </div>
        </div>
    </div>
</form>