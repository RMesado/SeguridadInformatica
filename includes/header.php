<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand mb-2 mt-2" href="#">
            <img class=".align-top .align-middle .align-bottom" alt="FileSafety"
                 src="images/descarga.jfif" width="50" height="50">
            FileSafety
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php
                if (!isset($_SESSION['u_id'])) {
                    ?>
                    <li class="nav-item mr-2 mb-2">
                    <span>
                        <!-- Trigger/Open The Modal -->
                        <button class="btn btn-outline-info my-2 my-sm-0"
                                id="loginbtn">
                            Iniciar sesión
                        </button>
                    </span>
                    </li>

                    <li class="nav-item">
                        <!-- Trigger/Open The Modal -->
                        <button class="btn btn-outline-info my-2 my-sm-0"
                                id="registerbtn">
                            Registrarse
                        </button>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item mr-2">
                    <span class="nav-link">
                        ¡Hola <?php echo($_SESSION['username']) ?>!
                    </span>
                    </li>
                    <li class="nav-item">
                        <!-- Trigger/Open The Modal -->
                        <button class="btn btn-outline-info my-2 my-sm-0"
                                id="logoutbtn">
                            Cerrar sesión
                        </button>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>