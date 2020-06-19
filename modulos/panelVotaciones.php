<?php
    $qryPilotos = "SELECT id, nombre FROM pilotos";
    $rtaPilotos = mysqli_query($cnx,$qryPilotos);

    $pilotos=[];

    while($row = mysqli_fetch_assoc($rtaPilotos)){
        array_push($pilotos,$row);
    }


    if(isset($_POST['borrar'])){

        $qryBorrar = "DELETE FROM encuestas";
        $rtaBorrar = mysqli_query($cnx,$qryBorrar);

        if($rtaBorrar){
            header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=ok&mensaje=datoBorrado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=error&mensaje=datoNoBorrado');
            die();
        }

    }

    if(isset($_POST['pilotos'])){

        $qryValidacion = "SELECT * FROM encuestas";
        $rtaValidacion = mysqli_query($cnx, $qryValidacion);

        $validacion = [];

        while($row = mysqli_fetch_assoc($rtaValidacion)){
            array_push($validacion, $row);
        }

        if(isset($validacion[1])){
            header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=error&mensaje=encuestaExistente');
            die();
        }else{
            $piloto = $_POST['pilotos'];

            if($piloto[0] == $piloto[1] || $piloto[1] == $piloto[2] || $piloto[0] == $piloto[2]){
                header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=error&mensaje=pilotoRepetido');
                die();
            }
            
            for ($i=0; $i < count($_POST['pilotos']); $i++) { 

                $qryNuevaEncuesta = "INSERT INTO encuestas (votos, piloto) VALUES (0, $piloto[$i])";
                $rtaNuevaEncuesta = mysqli_query($cnx, $qryNuevaEncuesta);

                if($rtaNuevaEncuesta[2]){
                    header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=ok&mensaje=datoActualizado');
                    die();
                }else{
                    header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=error&mensaje=datoNoActualizado');
                    die();
                }
            }
            
        }


    }

    if(isset($_POST['actualizar'])){

        $qryActualizar = "UPDATE usuarios SET Voto=1";
        $rtaActualizar = mysqli_query($cnx,$qryActualizar);

        if($rtaActualizar){
            header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=ok&mensaje=datoActualizado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=encuestas&estado=error&mensaje=datoNoActualizado');
            die();
        }

    }


    echo '<div class="cardEdit">';


    echo '<form method="post">';
    echo '<input type="hidden" value="1" name="borrar"/>';
    echo '<input type="submit" value="Borrar la encuesta actual"/>';
    echo '</form>';


    echo '<form method="post">';
    for ($i=0; $i < 3 ; $i++) { 
        echo '<p>Piloto '.($i+1).'</p>';
        echo '<select name="pilotos[]">';
        for ($x=0; $x < count($pilotos) ; $x++) { 
            echo '<option value="'. $pilotos[$x]['id'] .'">'. $pilotos[$x]['nombre'] .'</option>';
        }
        echo '</select>';

    }
    echo '<input type="submit" value="Guardar"/>';
    echo '</form>';


    echo '<form method="post">';
    echo '<input type="hidden" value="1" name="actualizar"/>';
    echo '<input type="submit" value="Actualizar los usuarios para que puedan votar"/>';
    echo '</form>';

    echo '</div>';

?>