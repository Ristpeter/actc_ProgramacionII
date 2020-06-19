<?php

$qryPilotos = "SELECT id, nombre FROM pilotos";
            $rtaPilotos = mysqli_query($cnx, $qryPilotos);

            $pilotos =[];

            while($row = mysqli_fetch_assoc($rtaPilotos)){

                array_push($pilotos,$row);
            }

            $qryIconos = "SELECT id, nombre FROM marcas";
            $rtaIconos = mysqli_query($cnx, $qryIconos);

            $iconos =[];

            while($row = mysqli_fetch_assoc($rtaIconos)){

                array_push($iconos,$row);
            }

    if(isset($_POST['id'])){

        $id = $_POST['id'];

        if(isset($_POST['Voto'])){

            $voto = $_POST['Voto'];

            $qryActualizacion = "UPDATE usuarios SET Voto=$voto WHERE usuarios.id=$id";
            $rtaActualizacion = mysqli_query($cnx, $qryActualizacion);


            if($rtaActualizacion){
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=ok&mensaje=datoActualizado');
                die();
            }else{
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=error&mensaje=datoNoActualizado');
                die();
            }

            

        }else if(isset($_POST['isAdmin'])){

            $isAd = $_POST['isAdmin'];

            $qryActualizacion = "UPDATE usuarios SET isAdmin=$isAd WHERE usuarios.id=$id";
            $rtaActualizacion = mysqli_query($cnx, $qryActualizacion);

            if($rtaActualizacion){
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=ok&mensaje=datoActualizado');
                die();
            }else{
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=error&mensaje=datoNoActualizado');
                die();
            }


            

        }else if(isset($_POST['borrar'])){

            $qryBorrar = "DELETE FROM usuarios WHERE id=$id";
            $rtaBorrar = mysqli_query($cnx, $qryBorrar);


            if($rtaBorrar){
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=ok&mensaje=datoBorrado');
                die();
            }else{
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=error&mensaje=datoNoBorrado');
                die();
            }

            

        }else{

            

            $changes = [];

            for ($i=0; $i < count($resultado) ; $i++) { 
                
                if($resultado[$i]['id'] == $_POST['id']){

                    foreach ($_POST as $key => $value) {
                        
                        if($_POST[$key] != $resultado[$i][$key]){
                            array_push($changes, $key);
                        }

                    }

                }

            }

            $colYdat = '';

            for($i = 0; $i < count($changes); $i++){

                if($i == count($changes) -1){
                    $colYdat = $colYdat.$changes[$i]."='".$_POST[$changes[$i]]."'";
                break;
                }
                $colYdat = $colYdat.$changes[$i]."='".$_POST[$changes[$i]]."', ";
            }

            $qryActualizacion = "UPDATE usuarios SET $colYdat WHERE usuarios.id=$id;";
            $rtaActualizacion = mysqli_query($cnx, $qryActualizacion);
            
            if($rtaActualizacion){
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=ok&mensaje=datoActualizado');
                die();
            }else{
                header('location:panel.php?seccion=panelcrud&edit=usuarios&estado=error&mensaje=datoNoActualizado');
                die();
            }


        }
    }



    for ($i=0; $i < count($resultado); $i++) { 

    echo '<div class="cardEdit">';

        echo '<form method="post">';
            echo '<p>Usuario</p>';
            echo '<input type="text" name="usuario" value="'. $resultado[$i]['usuario'] .'"/>';
            echo '<p>Nombre</p>';
              echo '<input type="text" name="nombre" value="'. $resultado[$i]['nombre'] .'"/>';
              echo '<p>Apellido</p>';
            echo '<input type="text" name="apellido" value="'. $resultado[$i]['apellido'] .'"/>';
            echo '<p>Email</p>';
            echo '<input type="email" name="email" value="'. $resultado[$i]['email'] .'"/>';
            echo '<p>Contraseña</p>';
            echo '<input type="password" name="contraseña" value="'. $resultado[$i]['contraseña'] .'"/>';
            echo '<p>Nacimiento</p>';
            echo '<input type="date" name="nacimiento" value="'. $resultado[$i]['nacimiento'] .'"/>';
            echo '<p>Icono de perfil</p>';
            echo '<select name="icono">';
                for ($a=0; $a < count($iconos); $a++) { 

                    if($iconos[$a]['id'] == $resultado[$i]['icono']){
                        echo '<option value="'. $iconos[$a]['id'] .'" selected="selected">'. $iconos[$a]['nombre'] .'</option>';
                        continue;
                    
                    }

                    echo '<option value="'. $iconos[$a]['id'] .'">'. $iconos[$a]['nombre'] .'</option>';
                }
            echo '</select>';
            echo '<p>Piloto favorito</p>';
            echo '<select name="piloto_id">';
                for ($p=0; $p < count($pilotos); $p++) { 

                    if($pilotos[$p]['id'] == $resultado[$i]['piloto_id']){
                        echo '<option value="'. $pilotos[$p]['id'] .'" selected="selected">'. $pilotos[$p]['nombre'] .'</option>';
                        continue;
                    }

                    echo '<option value="'. $pilotos[$p]['id'] .'">'. $pilotos[$p]['nombre'] .'</option>';
                }
            echo '</select>';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        if($resultado[$i]['Voto'] == 0){
            echo '<form method="post">';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="1" name="Voto"/>';
                echo '<input type="submit" value="Ya voto"/>';
            echo '</form>';
        }else{
            echo '<form method="post">';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="0" name="Voto"/>';
                echo '<input type="submit" value="No voto"/>';
            echo '</form>';
        }

        if($resultado[$i]['isAdmin'] == 0){
            echo '<form method="post">';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="1" name="isAdmin"/>';
                echo '<input type="submit" value="No es administrador"/>';
            echo '</form>';
        }else{
            echo '<form method="post">';
                echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
                echo '<input type="hidden" value="0" name="isAdmin"/>';
                echo '<input type="submit" value="Es administrador"/>';
            echo '</form>';
        }

        echo '<form method="post">';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
            echo '<input type="hidden" value="1" name="borrar"/>';
            echo '<input type="submit" value="Borrar"/>';
        echo '</form>';

    echo '</div>';

    }

?>