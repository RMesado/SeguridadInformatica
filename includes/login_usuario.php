<?php
    require '../encrypt_decrypt.php';

    function login_usuario($conn, $user, $passwd)
    {
        try {

            $consulta_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE (email = '$user' OR username ='$user')");
            $result_login = mysqli_fetch_assoc($consulta_login);

            $aux = password_verify($passwd, $result_login['password']);

            if ($result_login) {
                if ($aux) {
                    // Esto es para comprobar si el usuario a activado la cuenta
                    // ahora mismo no tenemos esa opción por eso salia un error
                    //if ($result_login['status'] == 1) {
                        session_start();

                        $_SESSION['u_id'] = $result_login['userId'];
                        $_SESSION['username'] = $result_login['username'];

                        decrypt();

                        header('Location: https://filesafety.000webhostapp.com/');

                    //} else {
                       // header("Location: ../login.php?log=nact");
                       // exit();
                   // }
                } else {
                    header('Location: ../login.php?log=error1');
                }
                exit();
            }
        } catch (PDOException $ex) {
            header('Location: ../login.php?log=error2');
            exit();
        }
    }
