<?php
    const FILES = '/files/';
    const FILE_ENCRYPTION_BLOCKS = 10000;
    const ITERATIONS = 2000;

    function encrypt()
    {
        $id_user = $_SESSION['u_id'];
        $dir = __DIR__.FILES . $id_user . '/';
        $directorio = opendir($dir);

        $pass = getPass($id_user);
        $salt = openssl_random_pseudo_bytes(16);
        $key = hash_pbkdf2("sha256", $pass, $salt, ITERATIONS, 20);

        while ($fichero = readdir($directorio)) {
            if ($fichero!= '.' && $fichero != '..')
            {
                $filename = $dir.$fichero;
                $filenameEnc = $dir.$fichero.'*enc';

                encryptFile($filename, $key, $filenameEnc, $salt);
                unlink($filename);
            }
        }
    }

    function getPass($id_user){
        require 'conector_BD.php';
        $conn->set_charset('uft8');

        $result = $conn->query('SELECT * FROM `usuarios` WHERE `userId` = '.$id_user);
        $row = $result->fetch_assoc();

        return $row['password'];
    }

    function encryptFile($source, $key, $dest, $salt)
    {
        $iv = openssl_random_pseudo_bytes(16);

        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            // Put the initialzation vector to the beginning of the file
            fwrite($fpOut, $salt);
            fwrite($fpOut, $iv);
            if ($fpIn = fopen($source, 'rb')) {
                while (!feof($fpIn)) {
                    $plaintext = fread($fpIn, 16 * FILE_ENCRYPTION_BLOCKS);
                    $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $ciphertext);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }

        return $error ? null : $dest;
}

    function decrypt(){
        $id_user = $_SESSION['u_id'];
        $dir = __DIR__.FILES . $id_user . '/';
        $directorio = opendir($dir);

        $pass = getPass($id_user);

        while ($fichero = readdir($directorio)) {
            if ($fichero!= '.' && $fichero != '..')
            {
                $filenameEnc = $dir.$fichero;
                $file  = explode("*", $fichero);
                $filename = $dir.$file[0];

                decryptFile($filenameEnc, $pass, $filename);
                unlink($filenameEnc);
            }
        }
    }

    function decryptFile($source, $pass, $dest)
    {
        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            if ($fpIn = fopen($source, 'rb')) {
                // Get the initialzation vector from the beginning of the file
                $salt = fread($fpIn, 16);
                $key = hash_pbkdf2("sha256", $pass, $salt, ITERATIONS, 20);
                $iv = fread($fpIn, 16);
                while (!feof($fpIn)) {
                    $ciphertext = fread($fpIn, 16 * (FILE_ENCRYPTION_BLOCKS + 1)); // we have to read one block more for decrypting than for encrypting
                    $plaintext = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $plaintext);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }

        return $error ? null : $dest." ".$salt;
    }