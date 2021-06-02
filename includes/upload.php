<?php
    include "conector_BD.php";
    include "functions.php";
    include "../encrypt_decrypt.php";
    $conn->set_charset('uft8');
    session_start();

    if (isset($_SESSION['u_id'])) {
        if (isset($_POST['upload-files']) && $_FILES['files']['name'][0] != null) {
            $user_id = $_SESSION['u_id'];

            // Los datos de los archivos
            $nombre = $_FILES['files']['name'];
            $size = count($_FILES['files']['tmp_name']);
            $tmp = $_FILES['files']['tmp_name'];


            $dir = FILES . $user_id . '/';
            $ruta = $_SERVER['DOCUMENT_ROOT'] . $dir;

            if (!is_dir($ruta)){
                mkdir($ruta, 0777);
            }

            $alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";

            $created_at = date("Y-m-d H:i:s");

            for ($i = 0; $i < $size; $i++) {
                $code = "";

                for ($j = 0; $j < 12; $j++) {
                    $code .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
                }

                $nombre_img = $_FILES['files']['name'][$i];
                $filesize = $_FILES['files']['size'][$i];

                // Muevo el fichero desde el directorio temporal a nuestra ruta indicada anteriormente
                $move = move_uploaded_file($tmp[$i], $ruta . $nombre_img);
                $upload = upload_file($conn, $code, $nombre_img, $filesize, $user_id, $created_at);

                if (!$move && $upload < 1){
                    header('Location: ../index.php?=error_upload');
                }
                $pass = getPass($user_id);
                $sazonado = openssl_random_pseudo_bytes(16);
                $llave = hash_pbkdf2("sha256", $pass, $sazonado, ITERACIONES, 20);
                cifrar_archivo($ruta.$nombre_img, $llave, $ruta.$nombre_img.'*enc', $sazonado);
                unlink($ruta.$nombre_img);
            }

            header('Location: ../index.php');
        } else {
            header('Location: ../index.php?msg=error_no_files');
        }

    } else{
        header('Location: ../index.php');
    }

    exit();

    function upload_file($conn, $code, $nombre, $filesize, $user_id, $created_at)
    {
        try {
            $vacio = null;

            $stmt = $conn->prepare($query = "INSERT INTO `files` VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('issiis', $vacio, $code, $nombre, $filesize, $user_id, $created_at);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            exit();
        }
    }
?>