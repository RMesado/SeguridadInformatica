<?php
require_once 'conector_BD.php';
require_once 'registrar_usuario.php';

// comprobar que los formularios de han completado
global $conn;
if(isset($_POST['registrosubmit']))
{
    // iniciar la sesión que se pueda necesitar porteriormente
    // iniciarla ahora porque debe ir antes de los encabezados
    //    session_start();

    $email = trim($_POST["email"]);
    $alias = trim($_POST["username"]);
    $passwd = trim($_POST["password"]);
    $passwd2 = trim($_POST["password2"]);

    $_SESSION['email'] = $email;
    $_SESSION['username'] = $alias;
    $_SESSION['passwd'] = $passwd;
    $patron = "/\S+@\S+\.\S+/";

    try
    {
        // la dirrección de correo elecctrónico no es válida

//        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
//        {
//            header("Location: ../login.php?msg=error1");
//            throw new Exception("");
//        }
//
//        // las contraseñas no coinciden
//        if ($passwd != $passwd2)
//        {
//            header("Location: ../login.php?msg=error2");
//            throw new Exception("");
//        }
//
//        // comprobar si la longitud de la contraseña es correcta
//        if ((strlen($passwd) < 6) || (strlen($passwd) > 16))
//        {
//            header("Location: ../login.php?msg=error3");
//            throw new Exception("");
//        }
        $passwd = password_hash($passwd, PASSWORD_BCRYPT);
        registrar_usuario($conn, $alias, $email, $passwd);

        $_SESSION['email'] = "";
        $_SESSION['username'] = "";
        $_SESSION['passwd'] = "";
        header("Location: https://filesafety.000webhostapp.com/");
    }
    catch (Exception $e)
    {
        echo $e->getMessage();

        exit();
    }
}
else
{
    header("Location: ../login.php?msg=error");
    exit();
}
?>