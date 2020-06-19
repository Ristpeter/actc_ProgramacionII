<?php
    $link = $_GET['noticia'];

    $qryNoticia = "SELECT id, titulo, descripcion, imagen, fecha FROM noticias WHERE link = '$link'";

    $rtaNoticias = mysqli_query($cnx, $qryNoticia);

    $noticias = mysqli_fetch_assoc($rtaNoticias);

    $noticiaID= $noticias['id'];

    $qryPilotos = "SELECT pilotos_has_noticias.noticia, pilotos_has_noticias.piloto, pilotos.nombre, pilotos.casco, pilotos.link FROM pilotos_has_noticias, pilotos WHERE pilotos_has_noticias.noticia='$noticiaID' AND pilotos.id=pilotos_has_noticias.piloto ORDER BY pilotos.numero DESC;";
    
    $rtaPilotos = mysqli_query($cnx, $qryPilotos);

    $pilotos = [];

    while($row = mysqli_fetch_assoc($rtaPilotos)){

        array_push($pilotos, $row);

    }

    $qryMarcas = "SELECT marcas_has_noticias.noticia, marcas_has_noticias.marca, marcas.nombre, marcas.imagen, marcas.id FROM marcas_has_noticias, marcas WHERE marcas_has_noticias.noticia='$noticiaID' AND marcas.id=marcas_has_noticias.marca;";
    
    $rtaMarcas = mysqli_query($cnx, $qryMarcas);

    $marcas = [];

    while($row = mysqli_fetch_assoc($rtaMarcas)){

        array_push($marcas, $row);

    }

    $qryComentarios = "SELECT comentarios.id, comentarios.comentario, comentarios.fecha, comentarios.noticia_id, usuarios.usuario, marcas.nombre AS marca, marcas.imagen FROM comentarios JOIN usuarios ON usuarios.id=comentarios.usuario_id JOIN marcas ON marcas.id=usuarios.icono;";
    $rtaComentarios = mysqli_query($cnx, $qryComentarios);

    $comentarios = [];

    while($row = mysqli_fetch_assoc($rtaComentarios)){

        if($row['noticia_id'] == $noticiaID){
            array_push($comentarios, $row);
        }


    }
?>

<section class="noticia">
    <?php
        echo '<img src="img/noticias/'. $noticias['imagen'] .'" alt="'. $noticias['titulo'] .'" />';
        echo '<h2>'. $noticias['titulo'] .'</h2>';
        echo '<div>'. $noticias['descripcion'] .'</div>';
        echo '<p>Publicado el: '. $noticias['fecha'] .'</p>';
        echo '<h3>Pilotos relacionados</h3>';
        echo '<ul class="relacionados">';
            for ($i=0; $i < count($pilotos); $i++) { 
                echo '<li>';
                    echo '<a href="?seccion=pilotos&piloto='. $pilotos[$i]['link'].'">';
                        echo '<img src="img/pilotos/cascos/'. $pilotos[$i]['casco'] .'" alt="Casco '. $pilotos[$i]['nombre'] .'"/>';
                        echo '<h4>'. $pilotos[$i]['nombre'] .'</h4>';
                    echo '</a>';
                echo '</li>';
            }
        echo '</ul>';

        echo '<h3>Marcas relacionadas</h3>';
        echo '<ul class="relacionados">';
            for ($i=0; $i < count($marcas); $i++) { 
                echo '<li>';
                    echo '<a href="?seccion=marcas#'. $marcas[$i]['nombre'].'">';
                        echo '<img src="img/marcas/'. $marcas[$i]['imagen'] .'" alt="'. $marcas[$i]['nombre'] .'"/>';
                        echo '<h4>'. $marcas[$i]['nombre'] .'</h4>';
                    echo '</a>';
                echo '</li>';
            }
        echo '</ul>';

        echo '<h3>Comentarios</h3>';
        echo '<ul class="comentarios">';

        if(count($comentarios) >= 1){
            
            for ($i=0; $i < count($comentarios); $i++) { 

                echo '<li>';
                    echo '<div>';
                
            
                    echo '<div>';
                        echo '<img src="img/marcas/'. $comentarios[$i]['imagen'] .'" alt="'. $comentarios[$i]['marca'] .'" />';
                        echo '<div>';
                            echo '<h4>'. $comentarios[$i]['usuario'] .'</h4>';
                            echo '<p>'. $comentarios[$i]['fecha'] .'</p>';
                            echo '</div>';
                    echo '</div>';
                    if(isset($_SESSION['usuario']) && $comentarios[$i]['usuario'] == $_SESSION['usuario']['usuario']){
                        echo '<label><span id="borrarComent"></span><form method="POST" action="acciones/borrarComentario.php"><input type="hidden" name="id" value="'. $comentarios[$i]['id'] .'"/><input type="hidden" name="link" value="'. $link .'"/> <input type="submit" value="Eliminar"/></form></label>';
                    }
                    echo '</div>';
                    echo '<div>';
                        echo '<p>'. $comentarios[$i]['comentario'] .'</p>';
                    echo '</div>';
                echo '</li>';
            }

            echo '</ul>';
        }else{
            echo '<p style="margin-bottom:30px; margin-top:10px;">No hay comentarios</p>';
        }

        if(isset($_SESSION['usuario'])){

            echo '<div class="añadirComentario">';
                    echo '<img src="img/marcas/'. $_SESSION['datos']['marcaImagen'] .'" alt="'. $_SESSION['datos']['marcaNombre'] .'" />';
                    echo '<form action="acciones/comentar.php" method="POST" >';
                        echo '<textarea name="comentario" maxlength="200" placeholder="Escribí algo"></textarea>';
                        echo '<input type="hidden" name="link" value="'. $link .'"/>';
                        echo '<input type="hidden" name="noticiaID" value="'. $noticiaID .'"/>';
                        echo '<input type="submit" value="Comentar"/>'; 
                    echo '</form>';
            echo '</div>';

        }
    ?>
</section>