<?php


    $qryNoticias = "SELECT titulo, imagen, link FROM noticias";
    $rtaNoticias = mysqli_query($cnx, $qryNoticias);
    $noticias=[];
    while($row = mysqli_fetch_assoc($rtaNoticias)){
        array_push($noticias, $row);
    }

?>

<section class="noticias">

    <h2>Novedades</h2>

    <div>

        <?php
            for($i = 0; $i < count($noticias); $i++){
                echo '<div>';
                    echo '<a href="?seccion=inicio&noticia='. $noticias[$i]['link'] .'">';
                        echo '<img src="img/noticias/'. $noticias[$i]['imagen'] .'" alt="'. $noticias[$i]['titulo'] .'" />';
                        echo '<div>';
                            echo '<h3>'. $noticias[$i]['titulo'] .'</h3>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';
            }

        ?>

    </div>


</section>