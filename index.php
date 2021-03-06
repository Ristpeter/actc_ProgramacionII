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
    <link rel="stylesheet" href="css/encuestas.css"/>
    <link rel="stylesheet" href="css/register.css"/>
    <link rel="stylesheet" href="css/perfil.css"/>
</head>
<body>
    <header class="headerIndex">
        <label>
            <span></span>
            <span></span>
            <span></span>
        </label>

        <h1><a href="index.php">Asosiación Corredores de Turismo de Carretera</a></h1>

        <label></label>

        <nav>
            <ul>
                <li>
                    <?php
                        if(!onSession()){
                            echo '<div class="navNoLog">';
                                echo '<a href="?seccion=login">Iniciar sesión</a>';
                                echo '<a href="?seccion=register">Registrarse</a>';
                            echo '</div>';
                        }else{
                            echo '<div class="navLog">';
                                echo '<div>';
                                    echo  '<div>';
                                        echo '<p>'. $_SESSION['usuario']['usuario'] .'</p>';
                                        echo '<p><a href="?seccion=perfil">Editar perfil</a></p>';
                                    echo '</div>';
                                echo  '</div>';
                                echo '<div>';
                                    if($_SESSION['usuario']['icono'] == 0){
                                        echo '<img src="img/registerPerfil.png" alt="Foto de perfil" />';
                                    }else{
                                        echo '<img src="img/marcas/'. $_SESSION['datos']['marcaImagen'] .'" alt="'. $_SESSION['datos']['marcaNombre'] .'" />';

                                    }
                                    
                                echo '</div>';
                            echo '</div>';
                        }
                    
                    ?>
                </li>
                <?php
                
                    foreach ($aMenu as $key => $value) {
                        echo '<li><a href="'. $value .'">'.$key.'</a></li>';
                    }
                
                ?>
            </ul>
        </nav>


    
    </header>

    <?php
        
            if(isset($_GET['estado']) && isset($_GET['mensaje']) && $_GET['estado'] == 'error'){

                echo '<div class="msjEstado mensajeErr">';

                    foreach ($aMensajesError as $key => $value) {
                        
                        if($key == $_GET['mensaje']){

                            echo '<p>'. $value .'</p>';

                        }

                    }

                    echo '<label id="btnCerrarStatus"><span>Cerrar</span></label>';

                echo '</div>';

            }else if(isset($_GET['estado']) && isset($_GET['mensaje']) && $_GET['estado'] == 'ok'){

                echo '<div class="msjEstado mensajeOk">';

                    foreach ($aMensajesOk as $key => $value) {
                            
                        if($key == $_GET['mensaje']){

                            echo '<p>'. $value .'</p>';

                        }

                    }

                    echo '<label id="btnCerrarStatus"><span>Cerrar</span></label>';

                echo '</div>';

            }

    ?>

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
                
            }else if($_GET['seccion'] == 'register'){

                require_once('modulos/register.php');
                
            }else if($_GET['seccion'] == 'login'){

                require_once('modulos/login.php');
                
            }else if($_GET['seccion'] == 'login'){

                require_once('modulos/login.php');
                
            }else if($_GET['seccion'] == 'perfil'){

                require_once('modulos/perfil.php');
                
            }else{
                require_once('modulos/inicio.php');
            }

        ?>
    </main>

    <script src="js/index.js"></script>
</body>
</html>