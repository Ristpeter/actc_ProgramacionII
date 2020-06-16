<?php

    require('config/arrays.php');
    require('config/config.php');
    require('config/function.php');

    if($_SESSION['usuario']['panel'] == 0){
        header('location:../index.php?estado=err&err=err');
        die();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
    <header>
        <a href="acciones/panelLogOut.php">Volver al inicio</a>
        <h1>Panel de control</h1>
    </header>

    <main>
        <?php
        
            if(!isset($_GET['seccion']) || $_GET['seccion'] == 'inicio'){
                require_once('modulos/panelIndex.php');
            }else if($_GET['seccion'] == 'panelcrud'){
                require_once('modulos/panelCRUD.php');
            }
        
        ?>
    </main>
</body>
</html>