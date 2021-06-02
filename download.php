<?php
// Si la variable archivo que pasamos por URL no esta
// establecida acabamos la ejecucion del script.
if (!isset($_GET['code']) || empty($_GET['code'])) {
    header('Location: index.php?error-download');
}
require "encrypt_decrypt.php";
require "includes/functions.php";

// Utilizamos basename por seguridad, devuelve el
// nombre del archivo eliminando cualquier ruta.
$code = basename($_GET['code']);
$datos_consulta = consultaficheros($code);
if(!empty($datos_consulta)) {
    $id = $datos_consulta["user_id"];
    $pass = getPass($id);
    $archivo = $datos_consulta["filename"];
    $archivo_cifrado = $archivo . '*enc';
    $ruta = $_SERVER['DOCUMENT_ROOT'] . FILES . $id . '/';
    if (is_file($ruta . $archivo_cifrado)) {
        if (!descifrar_archivo($ruta . $archivo_cifrado, $pass, $ruta . $archivo)) {
            unlink($ruta . $archivo_cifrado);
            header('Content-Type: application/force-download');
            header('Cache-Control: must-revalidate');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($ruta . $archivo));
            header('Content-Disposition: attachment; filename=' . $archivo);
            readfile($ruta . $archivo);
            $sazonado = openssl_random_pseudo_bytes(16);
            $llave = hash_pbkdf2("sha256", $pass, $sazonado, ITERACIONES, 20);

            if (!cifrar_archivo($ruta . $archivo, $llave, $ruta . $archivo_cifrado, $sazonado)) {
                unlink($ruta . $archivo);
            } else {
                header('Location: index.php?error-download');
            }

        } else {
            header('Location: index.php?error-download');
        }

    } else {
        header('Location: index.php?error-download');
    }
}else{
    header('Location: index.php');
}
exit();
?>


