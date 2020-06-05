<?php

    require('config/arrays.php');
    require('config/config.php');
    require('config/function.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo de Carretera</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/noticias.css"/>
    <link rel="stylesheet" href="css/pilotos.css"/>
    <link rel="stylesheet" href="css/marcas.css"/>
</head>
<body>
    <header>
        <h1>Asosiación Corredores de Turismo de Carretera</h1>
        <div></div>
        <label>
            <span></span>
            <span></span>
            <span></span>
        </label>
        <nav>
            <ul>
                <li>User</li>
                <li><a href="?seccion=inicio">Inicio</a></li>
                <li><a href="?seccion=pilotos">Pilotos</a></li>
                <li><a href="?seccion=marcas">Marcas</a></li>
                <li><a href="?seccion=encuesta">Encuesta</a></li>
            </ul>
        </nav>
    
    </header>

    <main>
        <?php

            if(!isset($_GET['seccion']) || $_GET['seccion'] == 'inicio'){

                if(isset($_GET['noticia'])){
                    require_once('modulos/noticia.php');
                }else{
                    require_once('modulos/inicio.php');
                }
        
            }else if($_GET['seccion'] == 'pilotos'){
                if(isset($_GET['piloto'])){
                    require_once('modulos/piloto.php');
                }else{
                    require_once('modulos/pilotos.php');
                }
                
            }else if($_GET['seccion'] == 'marcas'){

                require_once('modulos/marcas.php');
                
            }else if($_GET['seccion'] == 'encuesta'){

                require_once('modulos/encuesta.php');
                
            }else{
                require_once('modulos/inicio.php');
            }

        ?>
    </main>

    <script src="js/index.js"></script>
</body>
</html>