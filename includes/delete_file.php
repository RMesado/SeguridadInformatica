<?php
    require 'conector_BD.php';

    $conn->set_charset('uft8');
    session_start();

    if(isset($_GET['id']))
    {
        $id = $_SESSION['u_id'];
        $directorio = "files/" . $id;

        $id_file = $_GET['id'];

        $result = $conn->query('SELECT * FROM `files` WHERE `id` = '.$id_file);
        $row = $result->fetch_assoc();

        unlink('../'.$directorio.'/'.$row['filename'].'*enc');

        delete_file($conn, $id_file);

        header('Location: ../index.php');

    } else{
        header('Location: ../index.php?error_delete_file');
    }
    exit();

    function delete_file($conn, $id){
        return $conn->query('DELETE FROM `files` WHERE `id` = '.$id);
    }



