<?php
require_once 'conector_BD.php';
require_once 'login_usuario.php';

// comprobar que los formularios de han completado
global $conn;
if(isset($_POST['loginsubmit']))
{
    // iniciar la sesión que se pueda necesitar porteriormente
    // iniciarla ahora porque debe ir antes de los encabezados
    //    session_start();

    $user = trim($_POST["user"]);
    $passwd = trim($_POST["password"]);

    try
    {
        login_usuario($conn, $user, $passwd);

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
    header("Location: ../index.php?msg=error");
    exit();
}

