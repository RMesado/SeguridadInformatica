<?php
const FILES = '/files/';
const BLOQUES_CIFRADO_ARCHIVO = 10000;
const ITERACIONES = 1000;

//function encrypt()
//{
//    $id_user = $_SESSION['u_id'];
//    $dir = __DIR__ . FILES . $id_user . '/';
//    $directorio = opendir($dir);
//
//    $pass = getPass($id_user);
//    $sazonado = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
//    $llave = hash_pbkdf2("sha256", $pass, $sazonado, ITERACIONES, 20);
//
//    while ($fichero = readdir($directorio)) {
//        if ($fichero != '.' && $fichero != '..') {
//            $filename = $dir . $fichero;
//            $filenameEnc = $dir . $fichero . '*enc';
//
//            cifrar_archivo($filename, $llave, $filenameEnc, $pass);
//            unlink($filename);
//        }
//    }
//}

function cifrar_archivo($fichero, $llave, $destino, $sazonado)
{
    $iv = openssl_random_pseudo_bytes(16);

    $error = false;
    if ($fichero_destino = fopen($destino, 'w')) {

        // Escribe al principio del fichero el sazonado y vector de inicialización
        fwrite($fichero_destino, $sazonado);
        fwrite($fichero_destino, $iv);

        if ($fichero_origen = fopen($fichero, 'rb')) {
            while (!feof($fichero_origen)) {
                $texto_sin_cifrar = fread($fichero_origen, 16 * BLOQUES_CIFRADO_ARCHIVO);
                $texto_cifrado = openssl_encrypt($texto_sin_cifrar, 'AES-256-CBC', $llave, OPENSSL_RAW_DATA, $iv);

                // Los primeros 16 bytes del texto cifrado como el siguiente vector de inicialización
                $iv = substr($texto_cifrado, 0, 16);
                fwrite($fichero_destino, $texto_cifrado);
            }
            fclose($fichero_origen);
        } else {
            $error = true;
        }
        fclose($fichero_destino);
    } else {
        $error = true;
    }

    return $error;
}
//
//function decrypt()
//{
//    $id_user = $_SESSION['u_id'];
//    $dir = __DIR__ . FILES . $id_user . '/';
//    $directorio = opendir($dir);
//
//    $pass = getPass($id_user);
//
//    while ($fichero = readdir($directorio)) {
//        if ($fichero != '.' && $fichero != '..') {
//            $filenameEnc = $dir . $fichero;
//            $file = explode("*", $fichero);
//            $filename = $dir . $file[0];
//
//            descifrar_archivo($filenameEnc, $pass, $filename);
//            unlink($filenameEnc);
//        }
//    }
//}

function descifrar_archivo($fichero, $pass, $destino)
{
    $error = false;
    if ($fichero_destino = fopen($destino, 'w')) {
        if ($fichero_origen = fopen($fichero, 'rb')) {

            // Se obtiene el sazonado y el vector de inicializacion de las primeras líneas del fichero
            $sazonado = fread($fichero_origen, 16);
            $iv = fread($fichero_origen, 16);

            $llave = hash_pbkdf2("sha256", $pass, $sazonado, ITERACIONES, 20);

            while (!feof($fichero_origen)) {
                // Hay que leer un bloque mas para descifrar que para cifrar
                $texto_cifrado = fread($fichero_origen, 16 * (BLOQUES_CIFRADO_ARCHIVO + 1));
                $texto_sin_cifrar = openssl_decrypt($texto_cifrado, 'AES-256-CBC', $llave, OPENSSL_RAW_DATA, $iv);

                // Los primeros 16 bytes del texto cifrado como el siguiente vector de inicialización
                $iv = substr($texto_cifrado, 0, 16);
                fwrite($fichero_destino, $texto_sin_cifrar);
            }
            fclose($fichero_origen);
        } else {
            $error = true;
        }
        fclose($fichero_destino);
    } else {
        $error = true;
    }

    return $error;
}