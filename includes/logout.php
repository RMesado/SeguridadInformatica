<?php
    require '../encrypt_decrypt.php';
    session_start();

    $dir = '/files/' . $_SESSION['u_id']. '/';
    $ruta = $_SERVER['DOCUMENT_ROOT'] . $dir;

    if (is_dir($ruta)){
        encrypt();
    }


    unset($_SESSION['u_id']);

    header('Location: ../index.php');
    exit();

