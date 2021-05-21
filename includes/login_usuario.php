<?php

function login_usuario($conn, $user, $passwd)
{
    try {

        $consulta_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE (email = '$user' OR username ='$user')");
        $result_login = mysqli_fetch_assoc($consulta_login);
        echo($passwd." - ");
        $aux = password_verify($passwd, $result_login['password']);
        echo($aux." - ");
        if ($result_login) {
            echo("primer if");
            if ($aux) {
                echo("segundo if");
                if ($result_login['status'] == 1) {
                    session_start();

                    $_SESSION['u_id'] = $result_login['userId'];
                    $_SESSION['username'] = $result_login['username'];

                    header('Location: https://filesafety.000webhostapp.com/');

                    exit();
                } else {
                    header("Location: ../login.php?log=nact");
                    exit();
                }
            } else {
                header('Location: ../login.php?log=error1');
                exit();
            }
        }
        } catch (PDOException $ex) {
        header('Location: ../login.php?log=error2');
        exit();
    }
}

?>