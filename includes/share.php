<?php

function get_share($share)
{
    require_once 'conector_BD.php';
    $conn->set_charset('uft8');

    try {
        $consulta = mysqli_query($conn, "SELECT * FROM files");

        if (!empty($consulta)) {
            while ($row = mysqli_fetch_assoc($consulta))
                $files[] = $row;
        }

        if (!empty($files)) {
            foreach ($files as $value) {
                if (password_verify($value['code'], $share)) {
                    return $value;
                }
            }
        }
    } catch (PDOException $ex) {
        header('Location: ../index.php?log=error2');
        exit();
    }
}