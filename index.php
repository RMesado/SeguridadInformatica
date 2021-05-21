<?php
session_start();
//include(dirname(__FILE__) . "/includes/conector_BD.php");
include(dirname(__FILE__) . "/includes/registrar_usuario.php");
include(dirname(__FILE__) . "/includes/login_usuario.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>FileSafety</title>
    <script src="funciones.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css" type="text/css">

</head>
<body>
<?php
include_once "includes/header.php";
?>
<main class="flex-shrink-0">
    <div class="container p-2">
        <?php
        if (!isset($_SESSION['u_id'])) {
            ?>
            <div id="espacioBlanco">
                <h1>¿Quieres almacenar cosas de forma segura? Has llegado al lugar indicado! :3</h1>
                <h2>Regístrate o inicia sesión para almacenar tus archivos. Tranquilo/a, estarán seguros con nosotros
                    jeje</h2>
                <h2>Y puedes compartirlos medianto una URL! WOW!</h2>
                <img alt="gif to guapo" src="https://media.tenor.com/images/5185e189880510119152ade7d0859fcc/tenor.gif">
            </div>
            <?php
        } else {
            include_once "includes/ficheros.php";
        }
        ?>
    </div>
</main>

<?php
include_once "includes/footer.php";
?>

<!-- LOGIN Modal -->
<div id="login" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <header class="modal-header">
            <h5 class="modal-header">Datos de inicio de sesión</h5>
            <button aria-label="Close" class="close">&times;</button>
        </header>
        <form class="form_usuario" action="includes/loginUsuario-intermedio.php" method="post">
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
        </form>
    </div>
</div>

<!--Register modal-->
<div id="register" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <header class="modal-header">
            <h5>Datos de registro</h5>
            <button aria-label="Close" class="close">&times;</button>
        </header>
        <form class="form-group" action="includes/regUsuario-intermedio.php" method="post">
            <div class="form-group">
                <label for="reg_username">Usuario</label>
                <input type="text" class="form-control" id="reg_username" name="username"
                       placeholder="Introduce un usuario" required/>
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Introduce un email"
                       required/>
            </div>
            <div class="form-group">
                <label for="reg_password">Contraseña</label>
                <input class="form-control" type="password" id="reg_password" name="password"
                       placeholder="Introduce una contraseña" required/>
            </div>
            <div class="form-group">
                <label for="password2">Confirma la contraseña</label>
                <input class="form-control" type="password" id="password2" name="password2"
                       placeholder="Confirma la contraseña" required/>
            </div>
            <div class="form-group">
                <button class="btn btn-dark" type="submit" name="registrosubmit">Registrarse</button>
            </div>
            <div class="form-group">
                <p>¿Ya tienes cuenta?
                    <a href="javascript:changeModal()">Inicia sesión</a>
                </p>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script type="application/javascript">
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