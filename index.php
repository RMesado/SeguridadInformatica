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
    <link rel="stylesheet" href="estilo.css" type="text/css">
</head>
<body>
<div id="nav">
    <div id="logo">
        <div id="img-logo">
            <img alt="FileSafety" src="images/descarga.jfif">
        </div>
        <div id="nombre-logo">
            <h1>FileSafety</h1>
        </div>
    </div>
    <?php
    if (!isset($_SESSION['u_id'])) {
        ?>
        <div class="userbtns" id="inicio-sesion">
            <!-- Trigger/Open The Modal -->
            <button id="loginbtn">Iniciar sesión</button>
        </div>

        <div class="userbtns" id="registro">
            <!-- Trigger/Open The Modal -->
            <button id="registerbtn">Registrarse</button>
        </div>
        <?php
    } else {
        ?>
        <div class="userbtns" id="inicio-sesion">
            <!-- Trigger/Open The Modal -->
            <span>¡Hola <?php echo($_SESSION['username']) ?>!</span>
        </div>
        <div class="userbtns" id="logout">
            <!-- Trigger/Open The Modal -->
            <button id="logoutbtn">Cerrar sesión</button>
        </div>
    <?php } ?>
</div>
<div id="espacioBlanco">
    <h1>¿Quieres almacenar cosas de forma segura? Has llegado al lugar indicado! :3</h1>
    <h2>Regístrate o inicia sesión para almacenar tus archivos. Tranquilo/a, estarán seguros con nosotros jeje</h2>
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
                <legend>Datos básicos</legend>
                <label>Usuario</label>
                <br/>
                <label>
                    <input type="text" id="login_username" name="user" required/>
                </label>
                <br/>
                <br/>
                <label>Contraseña</label>
                <br/>
                <label>
                    <input type="password" id="login_password" name="password" required/>
                </label>
                <br/>
                <br/>
                <button type="submit" name="loginsubmit">Iniciar sesión</button>
                <p>¿Aún no tienes cuenta?
                    <a href="javascript:changeModal()">Regístratre</a>
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
                <legend>Datos básicos</legend>
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
                <label>Contraseña</label>
                <br/>
                <label>
                    <input type="password" id="reg_password" name="password" required/>
                </label>
                <br/>
                <br/>
                <label>Confirma la contraseña</label>
                <br/>
                <label>
                    <input type="password" id="password2" name="password2" required/>
                </label>
                <br/>
                <br/>
                <button type="submit" name="registrosubmit">Registrarse</button>
                <p>¿Ya tienes cuenta?
                    <a href="javascript:changeModal()">Inicia sesión</a>
                </p>
            </fieldset>
        </form>
    </div>
</div>
<script>
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


