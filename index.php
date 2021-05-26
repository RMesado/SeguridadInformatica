<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>FileSafety</title>
    <script src="funciones.js"></script>

    <link rel="shortcut icon" type="image/jpg" href="images/filesecurity.png"/>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css" type="text/css">

</head>
<body>
<?php
include_once "includes/header.php";
?>
<main class="flex-shrink-0">
    <div class="container">
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

<div class="modal" id="share" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LOGIN Modal -->
<div id="login" class="modal" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Datos de inicio de sesión</h5>
                <button aria-label="Close" class="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">
                    <div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <form class="form-group needs-validation" novalidate action="includes/loginUsuario-intermedio.php"
                                          method="post">
                                        <div class="form-group">
                                            <h4>Usuario</h4>
                                            <input onkeyup="validacionUsername(this)" type="text" class="form-control" id="reg_username" name="user"
                                                   placeholder="Introduce usuario o email" required/>
                                            <div class ="invalid-feedback">Introduce un usuario válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Contraseña</h4>
                                            <input onkeyup="validacionPasswd(this)" class="form-control" type="password" id="reg_password"
                                                   name="password"
                                                   placeholder="Introduce la contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                            <div class ="invalid-feedback">Introduce una contraseña de al menos 8 caracteres, una mayúscula y un número</div>
                                        </div>
                                        <button class="btn btn-dark btn-block" type="submit" name="loginsubmit">Iniciar
                                            sesión
                                        </button>
                                        <div class="form-group">
                                            <p>¿Aún no tienes cuenta?
                                                <a href="javascript:changeModal()">Regístratre</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Register modal-->
<div id="register" class="modal" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Datos de registro</h5>
                <button aria-label="Close" class="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">
                    <div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <form class="form-group needs-validation" oninput='password2.setCustomValidity(password2.value != reg_password.value ? "Las contraseñas no coinciden" : "")' novalidate action="includes/regUsuario-intermedio.php" method="post">
                                        <div class="form-group">
                                            <h4>Usuario</h4>
                                            <input type="text" class="form-control" id="reg_username" name="username"
                                                   placeholder="Introduce un usuario" required/>
                                            <div class ="invalid-feedback">Introduce un usuario válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Correo</h4>
                                            <input class="form-control" type="email" id="email" name="email"
                                                   placeholder="Introduce un email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                   required/>
                                            <div class ="invalid-feedback">Introduce un email válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Contraseña</h4>
                                            <input class="form-control" type="password" id="reg_password"
                                                   name="password1"
                                                   placeholder="Introduce una contraseña" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                            <div class ="invalid-feedback">Introduce una contraseña de al menos 8 caracteres, una mayúscula y un numero</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Confirma la contraseña</h4>
                                            <input class="form-control" type="password" id="password2" name="password2"
                                                   placeholder="Confirma la contraseña" required/>
                                            <div class ="invalid-feedback">Las contraseñas deben coincidir</div>
                                        </div>
                                        <button class="btn btn-dark btn-block" type="submit" name="registrosubmit">
                                            Registrarse
                                        </button>
                                        <div class="form-group">
                                            <p>¿Ya tienes cuenta?
                                                <a href="javascript:changeModal()">Inicia sesión</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script type="application/javascript">
    // Get the modal
    var modal_Login = document.getElementById("login");
    var modal_register = document.getElementById("register");
    let modal_share = document.getElementById('share');

    // Get the button that opens the modal
    var loginbtn = document.getElementById("loginbtn");
    var registerbtn = document.getElementById("registerbtn");

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

        if (event.target === modal_share) {
            modal_share.style.display = "none";
        }
    }
    var input = document.getElementById( 'fichero' );
    var infoArea = document.getElementById( 'nfichero' );
    if (input != null) {
        input.addEventListener( 'change', showFileName );
    }
    function showFileName( event ) {

        var input = event.srcElement;
        try{var fileName = input.files[0].name;
            infoArea.textContent = fileName;
        }catch(error){}
    }

    <?php
    if (isset($_GET['share'])){
    ?>
        document.addEventListener("DOMContentLoaded", (event) => {
            modal_share.style.display = 'block';
        });

    <?php
    }
    ?>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>