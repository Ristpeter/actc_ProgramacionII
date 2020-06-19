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
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/panel.css"/>
    <title>Panel</title>
</head>
<body>
    <header class="headerPanel">
        <?php

            $edit = isset($_GET['edit'])?$_GET['edit']: '';
        
            if(isset($_GET['seccion']) && $_GET['seccion'] == 'panelcrud'){
                echo '<a href="panel.php">Volver al inicio <span id="Volver"></span></a>';
            }else if(isset($_GET['seccion']) && $_GET['seccion'] == 'crear'){
                echo '<a href="panel.php?seccion=panelcrud&edit='.$edit.'">Volver al inicio <span id="Volver"></span></a>';
            }else{
                echo '<a href="acciones/panelLogOut.php">Volver al inicio <span id="Volver"></span></a>';
            }

        ?>
        
        <h1>Panel de control</h1>

        <?php

            if(isset($_GET['edit']) && $_GET['edit'] != 'encuestas' && $_GET['seccion'] != 'crear'){
                if($_GET['edit'] != 'usuarios'){
                    echo '<a href="?seccion=crear&edit='. $_GET['edit'] .'">Crear una nueva <span id="crearNuevo"></span></a>';
                }
            
            }

        ?>
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
                require_once('modulos/panelIndex.php');
            }else if($_GET['seccion'] == 'panelcrud'){
                require_once('modulos/panelCRUD.php');
            }else if($_GET['seccion'] == 'crear'){
                require_once('modulos/panelCrear.php');
            }

        
        ?>
    </main>

    
    <script src="js/index.js"></script>
</body>
</html>