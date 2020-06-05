<?php
    $link = $_GET['noticia'];

    $qry = "SELECT titulo, descripcion, imagen, fecha FROM noticias WHERE link = '$link'";

    $rta = mysqli_query($cnx, $qry);
    $noticia = mysqli_fetch_assoc($rta);

?>

<section class="noticia">
    <?php
        echo '<img src="img/noticias/'. $noticia['imagen'] .'" alt="'. $noticia['titulo'] .'" />';
        echo '<h2>'. $noticia['titulo'] .'</h2>';
        echo '<div>'. $noticia['descripcion'] .'</div>';
        echo '<p>Publicado el: '. $noticia['fecha'] .'</p>';
    ?>
</section>