<?php

    $qry = "SELECT pilotos.nombre AS pilotoNombre, pilotos.imagen AS pilotoImagen, pilotos.equipo, pilotos.numero, pilotos.link, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen FROM pilotos JOIN marcas ON pilotos.marca=marcas.id";

    $rta = mysqli_query($cnx, $qry);
    $pilotos=[];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($pilotos, $row);
    }


?>

<section class="pilotos">
    <h2>Pilotos</h2>
    <div>
        <?php

            for($i = 0; $i < count($pilotos); $i++){
                
                echo '<div>';
                    echo '<a href="?seccion=pilotos&piloto='. $pilotos[$i]['link'].'">';
                        echo '<img src="img/pilotos/'. $pilotos[$i]['pilotoImagen'] .'" alt="'. $pilotos[$i]['pilotoNombre'] .'"/>';
                        echo '<div>';
                            echo '<h3>'. $pilotos[$i]['pilotoNombre'] .'</h3>';
                            echo '<div>';
                                echo '<div>';
                                echo '<p>'. $pilotos[$i]['equipo'] .'</p>';
                                echo '<img src="img/marcas/'. $pilotos[$i]['marcaImagen'] .'" alt="'. $pilotos[$i]['marcaNombre'] .'" />';
                                echo '</div>';
                                echo '<div>';
                                echo '<p><span>'. $pilotos[$i]['numero'] .'</span></p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';

            }

        ?>
    </div>
</section>