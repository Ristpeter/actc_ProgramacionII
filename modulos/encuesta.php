<?php

    $qry = "SELECT encuestas.id, encuestas.votos, pilotos.id AS pilotoID, pilotos.nombre, pilotos.imagen, pilotos.numero, pilotos.equipo, pilotos.casco, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen FROM encuestas, pilotos, marcas WHERE encuestas.piloto=pilotos.id AND pilotos.marca=marcas.id;";

    $rta = mysqli_query($cnx, $qry);

    $encuesta = [];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($encuesta, $row);
    }

    if(isset($encuesta[2])){
        $votosTotales = $encuesta[0]['votos']+$encuesta[1]['votos']+$encuesta[2]['votos'];
    }

?>

<section class="encuesta">

    <h2>Votá tu piloto favorito</h2>

    <?php

        if(!isset($encuesta[2])){
            echo '<p>No hay votacioens por el momento</p>';
        }else{

            echo '<p>Total de votos: <span>'.$votosTotales.'</span></p>';

            echo '<div>';
        
            for($i = 0; $i < count($encuesta); $i++){

                echo '<div>';
                    echo '<img src="img/pilotos/'. $encuesta[$i]['imagen'] .'" alt="'. $encuesta[$i]['nombre'] .'" />';
                    echo '<div>';
                            echo '<h3>'. $encuesta[$i]['nombre'] .'</h3>';
                            echo '<div>';
                                echo '<img src="img/pilotos/cascos/'. $encuesta[$i]['casco'] .'" alt="Casco '. $encuesta[$i]['nombre'] .'" />';
                                echo '<p><span>'. $encuesta[$i]['numero'] .'</span></p>';
                            echo '</div>';
                            echo '<div>';
                                echo '<p>'. $encuesta[$i]['equipo'] .'</p>';
                                echo '<img src="img/marcas/'. $encuesta[$i]['marcaImagen'] .'" alt="'. $encuesta[$i]['marcaNombre'] .'" />';
                            echo '</div>';
                            echo '<div>';
                                echo '<p>Total de votos <span>'. $encuesta[$i]['votos'] .'</span></p>';

                                if($encuesta[$i]['votos'] == 0){
                                    echo '<p>Porcentaje <span> 0% </span></p>';
                                }else{
                                    echo '<p>Porcentaje <span>'. round(($encuesta[$i]['votos'] * 100 / $votosTotales),1) .'%</span></p>';
                                }
                                
                            echo '</div>';
                            echo '<form method="post" action="acciones/votacion.php"><input type="hidden" name="id" value="'. $encuesta[$i]['pilotoID'] .'"/><input type="submit" value="Votar"/></form>';
                    echo '</div>';
                    echo '</div>';


            }
            echo '</div>';
        }

    ?>

</section>