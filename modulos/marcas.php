<?php

    $qry = "SELECT nombre, imagen, biografia FROM marcas";

    $rta = mysqli_query($cnx, $qry);
    $marcas=[];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($marcas, $row);
    }

?>

<section class="marcas">

    <h2>Marcas</h2>
    <div>

        <?php
            for($i = 0; $i < count($marcas); $i++){

                echo '<div id="'. $marcas[$i]['nombre'] .'">';
                    echo '<div>';
                        echo '<h3>'. $marcas[$i]['nombre'] .'</h3>';    
                        echo '<img src="img/marcas/'. $marcas[$i]['imagen'] .'" alt="'. $marcas[$i]['nombre'] .'" />';
                    echo '</div>';
                    echo '<div>';
                        echo $marcas[$i]['biografia'];
                    echo '</div>';
                echo '</div>';

            }
        ?>
        
    </div>

</section>