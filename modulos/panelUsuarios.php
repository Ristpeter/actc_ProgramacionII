<?php

    echo '<div>';

        echo '<form action="acciones/editarCRUD.php" method="post">';
            echo '<input type="text" name="usuario" value="'. $resultado[$i]['usuario'] .'"/>';
            echo '<input type="text" name="nombre" value="'. $resultado[$i]['nombre'] .'"/>';
            echo '<input type="text" name="apellido" value="'. $resultado[$i]['apellido'] .'"/>';
            echo '<input type="email" name="email" value="'. $resultado[$i]['email'] .'"/>';
            echo '<input type="password" name="contraseña" value="'. $resultado[$i]['contraseña'] .'"/>';
            echo '<input type="date" name="nacimiento" value="'. $resultado[$i]['nacimiento'] .'"/>';
            echo '<input type="number" name="icono" value="'. $resultado[$i]['icono'] .'"/>';
            echo '<input type="number" name="piloto_id" value="'. $resultado[$i]['piloto_id'] .'"/>';
            echo '<input type="hidden" value="'. $table .'" name="table"/>';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        if($resultado[$i]['Voto'] == 0){
            echo '<form action="acciones/editarCRUD.php" method="post">';
                echo '<input type="hidden" value="'. $table .'" name="table"/>';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="1" name="Voto"/>';
                echo '<input type="submit" value="Ya voto"/>';
            echo '</form>';
        }else{
            echo '<form action="acciones/editarCRUD.php" method="post">';
                echo '<input type="hidden" value="'. $table .'" name="table"/>';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="0" name="Voto"/>';
                echo '<input type="submit" value="No voto"/>';
            echo '</form>';
        }

        if($resultado[$i]['isAdmin'] == 0){
            echo '<form action="acciones/editarCRUD.php" method="post">';
                echo '<input type="hidden" value="'. $table .'" name="table"/>';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="1" name="isAdmin"/>';
                echo '<input type="submit" value="No es administrador"/>';
            echo '</form>';
        }else{
            echo '<form action="acciones/editarCRUD.php" method="post">';
                echo '<input type="hidden" value="'. $table .'" name="table"/>';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="0" name="isAdmin"/>';
                echo '<input type="submit" value="Es administrador"/>';
            echo '</form>';
        }

        echo '<form action="" method="post">';
            echo '<input type="hidden" value="'. $table .'" name="table"/>';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
            echo '<input type="submit" value="Borrar"/>';
        echo '</form>';

    echo '</div>';

?>