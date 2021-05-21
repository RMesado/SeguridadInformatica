<?php
$dbServername = "localhost";
$dbUsername = "id16730542_admin";
$dbPassword = "\$OLxA_NQjr3ZF!-I";
$dbName = "id16730542_filesafety";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$conn->set_charset("utf8");;

if(mysqli_connect_errno())
{
    echo 'No se ha podido conectar con la Base de Datos: ', mysqli_connect_error();
    exit();
}
?>