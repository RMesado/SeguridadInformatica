<?php
include(dirname(__FILE__) . "/includes/functions.php");
session_start();
$fichero = null;
$fichero_size = null;
if (isset($_GET['share'])) {
    $fichero = consultaficheros($_GET['share']);
}
if (!empty($fichero)) {
    $fichero_size = getSize($fichero['filesize']);
    $code_hasheado = password_hash($fichero['code'], PASSWORD_BCRYPT);
    $directorio = "files/" . $fichero['user_id'];
}


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
            <div class="col-md-8 p-lg-8 mx-auto my-6 text-center">
                <h1 class="display-4 fw-normal">¿Quieres almacenar cosas de forma segura? ¡Has llegado al lugar
                    indicado! :3</h1>
                <p class="lead fw-normal">Regístrate o inicia sesión para almacenar tus archivos. Tranquilo/a, estarán
                    seguros con nosotros jeje. Y puedes compartirlos medianto una URL! WOW!</p>
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
            <div class="modal-header border-0">
                <?php
                $titulo = $fichero != null ? $fichero['filename'] : 'Fichero no encontrado';
                ?>
                <h5 class="modal-title" id="titleModal"><?php echo $titulo; ?></h5>
                <button aria-label="Close" class="close">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                if (!empty($fichero)) {

                    $ftype = explode(".", $titulo);
                    ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card shadow-sm">
<!--                                --><?php
//                                if (isImage($ftype)) {
//                                    ?>
<!--                                    <img alt="--><?php //echo $titulo; ?><!--" title="--><?php //echo $titulo; ?><!--"-->
<!--                                         style="align-self: center;" width="50%" height="50%"-->
<!--                                         src="--><?php //echo $directorio . '/' . $titulo; ?><!--"/>-->
<!--                                    --><?php
//                                } else {
//                                    ?>
                                    <div class="text-center icon-file-share">
                                        <?php
                                        echo getIcon($ftype, 210, 210);
                                        ?>
                                    </div>
<!--                                    --><?php
//                                }
//                                ?>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a title="Descargar" class="btn btn-sm btn-outline-secondary"
                                               href="download.php?code=<?php echo $code_hasheado; ?>">
                                                Descargar
                                            </a>
                                        </div>
                                        <small class="text-muted">Peso: <?php echo $fichero_size ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="text-center">
                        <img alt="no encontrado" style="align-self: center;" width="50%" height="50%"
                             src="images/no-encontrado.svg"/>
                    </div>
                    <?php
                }
                ?>
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
                                    <form class="form-group needs-validation" novalidate
                                          action="includes/loginUsuario-intermedio.php"
                                          method="post">
                                        <div class="form-group">
                                            <h4>Usuario</h4>
                                            <input onkeyup="validacionUsername(this)" type="text" class="form-control"
                                                   id="log_username" name="user"
                                                   placeholder="Introduce usuario o email" required/>
                                            <div class="invalid-feedback">Introduce un usuario válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Contraseña</h4>
                                            <input onkeyup="validacionPasswd(this)" class="form-control" type="password"
                                                   id="log_password"
                                                   name="password"
                                                   placeholder="Introduce la contraseña"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                            <div class="invalid-feedback">Introduce una contraseña de al menos 8
                                                caracteres, una mayúscula y un número
                                            </div>
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
                                    <form class="form-group needs-validation"
                                          oninput='password2.setCustomValidity(password2.value != reg_password.value ? "Las contraseñas no coinciden" : "")'
                                          novalidate action="includes/regUsuario-intermedio.php" method="post">
                                        <div class="form-group">
                                            <h4>Usuario</h4>
                                            <input type="text" class="form-control" id="reg_username" name="username"
                                                   placeholder="Introduce un usuario" required/>
                                            <div class="invalid-feedback">Introduce un usuario válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Correo</h4>
                                            <input class="form-control" type="email" id="email" name="email"
                                                   placeholder="Introduce un email"
                                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                   required/>
                                            <div class="invalid-feedback">Introduce un email válido</div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Contraseña</h4>
                                            <input class="form-control" type="password" id="reg_password"
                                                   name="password1"
                                                   placeholder="Introduce una contraseña" minlength="8"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                            <div class="invalid-feedback">Introduce una contraseña de al menos 8
                                                caracteres, una mayúscula y un numero
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Confirma la contraseña</h4>
                                            <input class="form-control" type="password" id="password2" name="password2"
                                                   placeholder="Confirma la contraseña" required/>
                                            <div class="invalid-feedback">Las contraseñas deben coincidir</div>
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
    let modal_Login = document.getElementById("login");
    let modal_register = document.getElementById("register");

    // Get the button that opens the modal
    let loginbtn = document.getElementById("loginbtn");
    let registerbtn = document.getElementById("registerbtn");

    // Get the <span> element that closes the modal
    let span_share = document.getElementsByClassName("close")[0];
    let span_login = document.getElementsByClassName("close")[1];
    let span_register = document.getElementsByClassName("close")[2];

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
    span_share.onclick = function () {
        modal_share.style.display = "none";
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
    };

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

<?php
if (isset($_SESSION['u_id'])) {
    ?>
    <script type="application/javascript">
        let input = document.getElementById('fichero');


        input.addEventListener("change", function () {
            let seleccionados;
            if (this.files.length > 1) {
                seleccionados = this.files.length + ' seleccionados';
            } else {
                seleccionados = this.files.length + ' seleccionado';
            }
            document.getElementById('nfichero').textContent = seleccionados;
        });

    </script>
    <?php
}
?>

<?php
if (isset($_GET['share'])) {
    ?>
    <script type="application/javascript">
        let modal_share = document.getElementById('share');

        document.addEventListener("DOMContentLoaded", (event) => {
            modal_share.style.display = 'block';
        });

    </script>
    <?php
}
?>
<script>
    function getlink(link) {
        let aux = document.createElement("input");
        aux.setAttribute("value", link);
        document.body.appendChild(aux);
        aux.select();
        try {
            document.execCommand("copy");
            var aviso = document.createElement("div");
            aviso.setAttribute("id", "aviso");
            var contenido = document.createTextNode("URL copiada");
            aviso.appendChild(contenido);
            document.body.appendChild(aviso);
            window.load = setTimeout("document.body.removeChild(aviso)", 2000);
        } catch (e) {
            alert('Tu navegador no soporta la función de copiar');
        }
        document.body.removeChild(aux);

    }
</script>
</body>
</html>