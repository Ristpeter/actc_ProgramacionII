<?php

    if(!empty($_POST['id'])){
        
        $id = $_POST['id'];

        $qryEncuesta = "UPDATE encuestas SET votos=votos+1 WHERE id=$id;";
    
        mysqli_query($cnx, $qryEncuesta);

    }

    $qry = "SELECT encuestas.id, encuestas.votos, pilotos.nombre, pilotos.imagen, pilotos.numero, pilotos.equipo, pilotos.casco, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen FROM encuestas, pilotos, marcas wHERE encuestas.piloto=pilotos.id AND pilotos.marca=marcas.id;";

    $rta = mysqli_query($cnx, $qry);

    $encuesta = [];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($encuesta, $row);
    }

    $votosTotales = $encuesta[0]['votos']+$encuesta[1]['votos']+$encuesta[2]['votos'];

?>

<section class="encuesta">

    <h2>Votá tu piloto favorito</h2>

    <p>Total de votos: <span><?php echo $votosTotales; ?></span></p>
    <div>
    <?php
    
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
                            echo '<p>Porcentaje <span>'. round(($encuesta[$i]['votos'] * 100 / $votosTotales),1) .'%</span></p>';
                        echo '</div>';
                        echo '<form method="post"><input type="hidden" name="id" value="'. $encuesta[$i]['id'] .'"/><input type="submit" value="Votar"/></form>';
                echo '</div>';
            echo '</div>';

        }

    ?>

    </div>

</section>