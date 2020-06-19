<?php

require_once("../config/config.php");

    if(isset($_POST['contraseña'])){

        $usrID = $_SESSION['usuario']['id'];

        if(password_verify ( $_POST['contraseña'] , $_SESSION['usuario']['contraseña'] )){

            $_SESSION['usuario']['panel'] = 1;
            header('location:../panel.php');
        }else{
            $_SESSION['usuario']['panel'] = 0;
            header('location:../index.php?estado=error&mensaje=datosErroneos');
            die();
        }

    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar al panel de control</title>
    <link rel="stylesheet" href="../css/panel.css"/>
</head>
<body>

    <main>

        <section class="loginPanel">

            <form method="POST">
                <p>Contraseña</p>
                <input type="password" name="contraseña"/>
                <input type="submit" value="Ingresar"/>
            </form>

        </section>

    </main>
    
</body>
</html>