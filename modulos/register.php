<?php

    $qry = "SELECT nombre, imagen FROM marcas;";

    $rta = mysqli_query($cnx,$qry);

    $img=[];

    while($row = mysqli_fetch_assoc($rta)){
        array_push($img,$row);
    }

?>

<section class="register">

<h2>Registrate y sé un piloto</h2>

<form>

    <img src="img/registerPerfil.jpg" alt="Imagen de perfil"/>

    <div>
        <?php
            for($i = 0; $i < count($img); $i++) {
                echo '<input type="radio" name="icono" value="'. $img[$i]['nombre'] .'" id="'. $img[$i]['nombre'] .'"/>';

                echo '<label for="'. $img[$i]['nombre'] .'">';
                echo '<img src="img/marcas/'. $img[$i]['imagen'] .'" alt="'. $img[$i]['nombre'] .'"/>';
                echo '</label>';
            }
        ?>
    </div>
</form>

</section>