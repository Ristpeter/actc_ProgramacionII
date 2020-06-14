<?php

    $link = $_GET['piloto'];

    $qry = "SELECT pilotos.id, pilotos.link, pilotos.nombre AS pilotoNombre, pilotos.biografia, pilotos.equipo, pilotos.imagen AS pilotoImagen, pilotos.nacimiento, pilotos.edad, pilotos.numero, pilotos.casco, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen FROM pilotos JOIN marcas ON pilotos.marca=marcas.id WHERE pilotos.link = '$link'";

    $rta = mysqli_query($cnx, $qry);

    $piloto = mysqli_fetch_assoc($rta);

    $idPiloto = $piloto['id'];

    $qryNoticias = "SELECT pilotos_has_noticias.noticia, pilotos_has_noticias.piloto, noticias.titulo, noticias.imagen, noticias.fecha, noticias.link FROM pilotos_has_noticias, noticias WHERE pilotos_has_noticias.piloto='$idPiloto' AND noticias.id=pilotos_has_noticias.noticia ORDER BY noticias.fecha DESC LIMIT 3;";

    $rtaNoticias = mysqli_query($cnx, $qryNoticias);

    $noticias = [];

    while($row = mysqli_fetch_assoc($rtaNoticias)){

        array_push($noticias, $row);

    }

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
        echo '<div>';
            echo '<h3>Noticias relacionadas</h3>';
            echo '<ul>';
                for($i = 0; $i < count($noticias); $i++){
                    echo '<li>';
                        echo '<a href="index.php?seccion=inicio&noticia='. $noticias[$i]['link'] .'">';
                            echo '<div>';
                                echo '</img src="img/noticias/'. $noticias[$i]['imagen'] .'" alt="'. $noticias[$i]['titulo'] .'">';
                            echo '</div>';
                            echo '<h4>'. $noticias[$i]['titulo'] .'</h4>';
                        echo '</a>';
                    echo '</li>';
                }

            echo '</ul>';
            echo '<a href="index.php?seccion=inicio&noticiasPilotos='. $piloto['link'] .'">Ver más</a>';
        echo '</div>';

    
    ?>

</section>