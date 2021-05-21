<?php

function registrar_usuario($conn, $username, $email, $passwd)
{
    try
    {
        $id = null;

        $stmt = $conn->prepare($query = "INSERT INTO usuarios VALUES(?,?,?,?)");
        $stmt->bind_param('isss', $id, $username, $email, $passwd);
        $stmt->execute();

        return $stmt;
    }
    catch(PDOException $ex)
    {
        echo $ex->getMessage();
    }
    return "";
}

?>