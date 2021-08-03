<form action="new-login.php" method="post">
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Iniciar sesion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input name="username" type="usuario" id="defaultForm-usuario" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Usuario</label>
          <p class = 'error-form'>Usuario inexistente</p>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input name="password" type="password" id="defaultForm-pass" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Contraseña</label>
          <p class = 'error-form'>Contraseña incorrecta</p>
        </div>

      </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" name="submit-login" class="btn btn-default">Iniciar sesion</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="new-login.php" method="post">
  <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Registrarse</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <input name="username" type="text" id="orangeForm-name" class="form-control validate">
            <label data-error="wrong" data-success="right" for="orangeForm-name">Usuario</label>
            <p class = 'error-form'>Usuario en uso</p>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-lock prefix grey-text"></i>
            <input name="password" type="password" id="orangeForm-password" class="form-control validate">
            <label data-error="wrong" data-success="right" for="orangeForm-email">Contraseña</label>
            <p class = 'error-form'>Contraseña no coincide</p>
          </div>

          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input name="password-confirm" type="password" id="orangeForm-pass" class="form-control validate">
            <label data-error="wrong" data-success="right" for="orangeForm-pass">Repetir contraseña</label>
            <p class = 'error-form'>Contraseña no coincide</p>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" name="submit-register" class="btn btn-deep-orange">Registrarse</button>
        </div>
      </div>
    </div>
  </div>
</form>