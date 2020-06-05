<?php

    $link = $_GET['piloto'];

    $qry = "SELECT pilotos.nombre AS pilotoNombre, pilotos.biografia, pilotos.equipo, pilotos.imagen AS pilotoImagen, pilotos.nacimiento, pilotos.edad, pilotos.numero, pilotos.casco, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen FROM pilotos JOIN marcas ON pilotos.marca=marcas.id WHERE pilotos.link = '$link'";

    $rta = mysqli_query($cnx, $qry);

    $piloto = mysqli_fetch_assoc($rta);

?>

<section class="piloto">

    <?php
    
        echo '<img src="img/pilotos/'. $piloto['pilotoImagen'] .'" alt="'. $piloto['pilotoNombre'] .'"/>';
        echo '<h2>'. $piloto['pilotoNombre'] .'</h2>';
        echo '<div>';
            echo '<img src="img/pilotos/cascos/'. $piloto['casco'] .'" alt="Casco '. $piloto['pilotoNombre'] .'"/>';
            echo '<p><span>'. $piloto['numero'] .'</span></p>';;
        echo '</div>';
        echo '<div>';
            echo '<p>'. $piloto['equipo'] .'</p>';
            echo '<a href="?seccion=marcas#'. $piloto['marcaNombre'] .'"><img src="img/marcas/'. $piloto['marcaImagen'] .'" alt="'. $piloto['marcaNombre'] .'"/></a>';
        echo '</div>';
        echo '<div> <h3>Biografía</h3>'. $piloto['biografia'] .' <p>Fecha de nacimiento: '. $piloto['nacimiento'] .'</p></div>';

    
    ?>

</section>