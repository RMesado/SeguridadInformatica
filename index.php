<?php
session_start();
include(dirname(__FILE__) . "/includes/conector_BD.php");
include(dirname(__FILE__) . "/includes/registrar_usuario.php");
include(dirname(__FILE__) . "/includes/login_usuario.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FileSafety</title>
    <script src="funciones.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css" type="text/css">

</head>
<body>
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
                            Iniciar sesiÃ³n
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
                        Â¡Hola <?php echo($_SESSION['username']) ?>!
                    </span>
                </li>
                <li class="nav-item">
                    <!-- Trigger/Open The Modal -->
                    <button class="btn btn-outline-info my-2 my-sm-0"
                            id="logoutbtn">
                        Cerrar sesiÃ³n
                    </button>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<div id="espacioBlanco">
    <h1>Â¿Quieres almacenar cosas de forma segura? Has llegado al lugar indicado! :3</h1>
    <h2>RegÃ­strate o inicia sesiÃ³n para almacenar tus archivos. Tranquilo/a, estarÃ¡n seguros con nosotros jeje</h2>
    <h2>Y puedes compartirlos medianto una URL! WOW!</h2>
    <img alt="gif to guapo" src="https://media.tenor.com/images/5185e189880510119152ade7d0859fcc/tenor.gif">
</div>


<!-- LOGIN Modal -->
<div id="login" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form_usuario" action="includes/loginUsuario-intermedio.php" method="post">
            <fieldset>
                <legend>Datos bÃ¡sicos</legend>
                <label>Usuario</label>
                <br/>
                <label>
                    <input type="text" id="login_username" name="user" required/>
                </label>
                <br/>
                <br/>
                <label>ContraseÃ±a</label>
                <br/>
                <label>
                    <input type="password" id="login_password" name="password" required/>
                </label>
                <br/>
                <br/>
                <button type="submit" name="loginsubmit">Iniciar sesiÃ³n</button>
                <p>Â¿AÃºn no tienes cuenta?
                    <a href="javascript:changeModal()">RegÃ­stratre</a>
                </p>
            </fieldset>
        </form>
    </div>
</div>

<!--Register modal-->
<div id="register" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form_usuario" action="includes/regUsuario-intermedio.php" method="post">
            <fieldset>
                <legend>Datos bÃ¡sicos</legend>
                <label>Usuario</label>
                <br/>
                <label>
                    <input type="text" id="reg_username" name="username" required/>
                </label>
                <br/>
                <br/>
                <label>Correo</label>
                <br/>
                <label>
                    <input type="email" id="email" name="email" required/>
                </label>
                <br/>
                <br/>
                <label>ContraseÃ±a</label>
                <br/>
                <label>
                    <input type="password" id="reg_password" name="password" required/>
                </label>
                <br/>
                <br/>
                <label>Confirma la contraseÃ±a</label>
                <br/>
                <label>
                    <input type="password" id="password2" name="password2" required/>
                </label>
                <br/>
                <br/>
                <button type="submit" name="registrosubmit">Registrarse</button>
                <p>Â¿Ya tienes cuenta?
                    <a href="javascript:changeModal()">Inicia sesiÃ³n</a>
                </p>
            </fieldset>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    // Get the modal
    var modal_Login = document.getElementById("login");
    var modal_register = document.getElementById("register");

    // Get the button that opens the modal
    var loginbtn = document.getElementById("loginbtn");
    var registerbtn = document.getElementById("registerbtn");
    var logoutbtn = document.getElementById("logoutbtn");

    // Get the <span> element that closes the modal
    var span_login = document.getElementsByClassName("close")[0];
    var span_register = document.getElementsByClassName("close")[1];

    // When the user clicks on the button, open the modal
    if (loginbtn != null) {
        loginbtn.onclick = function () {
            modal_Login.style.display = "block";
        }
    }
    if (registerbtn != null) {
        registerbtn.onclick = function () {
            modal_register.style.display = "block";
        }
    }
    if (logoutbtn != null) {
        logoutbtn.onclick = function () {
            <?php
            unset($_SESSION['u_id']);
            $_SESSION['username'] = '';
            ?>
            location.reload()
        }
    }

    // When the user clicks on <span> (x), close the modal
    span_login.onclick = function () {
        modal_Login.style.display = "none";
    }
    span_register.onclick = function () {
        modal_register.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === modal_Login) {
            modal_Login.style.display = "none";
        }
        if (event.target === modal_register) {
            modal_register.style.display = "none";
        }
    }

</script>
</body>
</html>