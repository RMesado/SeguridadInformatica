<?php
    require '../encrypt_decrypt.php';
    session_start();

    encrypt();

    unset($_SESSION['u_id']);

    header('Location: ../index.php');
    exit();

