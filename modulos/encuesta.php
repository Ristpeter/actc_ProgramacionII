<?php

    $qry = "SELECT encuestas.id, encuestas.votos, pilotos.nombre, pilotos.imagen, pilotos.numero, pilotos.equipo FROM encuestas JOIN pilotos ON encuestas.piloto=pilotos.id";


    $rta = mysqli_query($cnx, $qry);

    $encuesta = [];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($encuesta, $row);
    }

    $votosTotales = $encuesta[0]['votos']+$encuesta[1]['votos']+$encuesta[2]['votos'];

?>

<section class="encuesta">

    <h2>Votá tu piloto favorito</h2>

    <p>Total de votos: <?php echo $votosTotales; ?></p>
    <div>
    <?php
    
        for($i = 0; $i < count($encuesta); $i++){

            echo '<div>';
                echo '<img src="img/pilotos/'. $encuesta[$i]['imagen'] .'" alt="'. $encuesta[$i]['nombre'] .'" />';
                echo '<div>';

                echo '</div>';
            echo '</div>';

        }

    ?>

    </div>

</section>