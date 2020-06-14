<?php

require('config/config.php');

$table = $_GET['edit'];

$qry = "SELECT * FROM $table";

$rta = mysqli_query($cnx, $qry);

$resultado = [];

while($row = mysqli_fetch_assoc($rta)){

    array_push($resultado,$row);
}






echo '<section class="panelCrud">';
    print_r($resultado);

    echo  '<ul>';

        for($i = 0; $i < count($resultado); $i++){

            echo '<li>';

                if($table == 'usuarios'){
                    require_once('modulos/panelUsuarios.php');
                }else if($table == 'noticias'){
                    require_once('modulos/panelNoticias.php');
                }else if($table == 'pilotos'){
                    require_once('modulos/panelPilotos.php');
                }else if($table == 'marcas'){
                    require_once('modulos/panelMarcas.php');
                }else if($table == 'votaciones'){
                    require_once('modulos/panelVotaciones.php');
                }

                
            echo '</li>';
        }

    echo '</ul>';
echo '</section>';

?>

