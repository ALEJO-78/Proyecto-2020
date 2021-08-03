<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <a class="nav-link" href="recetas.php">Pedi ahora!</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="pedido.php">Mi carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos-usuario.php">Mis pedidos</a>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="main.php"><img src = '../IMG/logo.png' width="60px" height="50px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <?php
                if(!isset($_SESSION['username'])){

                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm">Iniciar Sesion</a>
                </li>
                <li class = 'nav-item'>
                    <a class="nav-link" data-toggle="modal" data-target="#modalRegisterForm">Registrarse</a>
                </li>
                <?php
                }
                else{
                ?>
                <li class="nav-item dropdown dropleft" >
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="nav-link " data-toggle="modal" data-target="#modalContraseñas" style = 'color: black;'>Cambiar contraseña</a>
                    <a class="nav-link " data-toggle="modal" data-target="#modalDirecciones" style = 'color: black;'>Mis direcciones</a>
                    <a href="cerrar-sesion.php" class="nav-link " style = 'color: red;'>Cerrar sesión</a>
                </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>