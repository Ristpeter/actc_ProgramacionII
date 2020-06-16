
<?php

    if(isset($_POST['id'])){

        $changes = '';
        $img =$_FILES['foto'];
        $nombreImg = $_FILES['foto']['name'];

        if(!empty($img['name'])){
            
            if($img['type'] != "image/png"){
                header('location:type');
                die();
            }

            if($img['size'] > 1048576){
                header('location:oooo');
                die();
            }
            
            $rtaImg = move_uploaded_file($img['tmp_name'], "img/noticias/$nombreImg");

            if($rtaImg){
                if(strlen($changes) == 0){
                    $changes = 'imagen="'.$nombreImg.'"';
                }else{
                    $changes = $changes.', imagen="'.$nombreImg.'"';
                }
            }
        }

        if(isset($_POST['titulo']) && $_POST['titulo'] != $resultado[$_POST['indice']]['titulo']){

            if(strlen($_POST['titulo']) > 120){
                header('location: aaaa');
                die();
            }

            if(strlen($changes) == 0){
                $changes = 'titulo="'.$_POST['titulo'].'"';
            }else{
                $changes = $changes.', titulo="'.$_POST['titulo'].'"';
            }

        }

        if(isset($_POST['descripcion']) && $_POST['descripcion'] != $resultado[$_POST['indice']]['descripcion']){

            if(strlen($_POST['descripcion']) > 21000){
                header('location: aaaa');
                die();
            }

            if(strlen($changes) == 0){
                $changes = 'descripcion="'.$_POST['descripcion'].'"';
            }else{
                $changes = $changes.', descripcion="'.$_POST['descripcion'].'"';
            }

        }

        if(isset($_POST['fecha']) && $_POST['fecha'] != $resultado[$_POST['indice']]['fecha']){

            if(strlen($changes) == 0){
                $changes = 'fecha="'.$_POST['fecha'].'"';
            }else{
                $changes = $changes.', fecha="'.$_POST['fecha'].'"';
            }

        }        

        if(isset($_POST['link']) && $_POST['link'] != $resultado[$_POST['indice']]['link']){

            if(strlen($_POST['link']) > 80){
                die();
            }

            if(strlen($changes) == 0){
                $changes = 'link="'.$_POST['link'].'"';
            }else{
                $changes = $changes.', link="'.$_POST['link'].'"';
            }

        }        

        if(isset($_POST['pilotosNoticias'])){

            for ($i=0; $i < count($pilotosNoticias); $i++) { 
                
                if(!in_array($pilotosNoticias[$i]['piloto'], $_POST['pilotosNoticias'])){

                    $pilotoID = $pilotosNoticias[$i]['piloto'];
                    $noticiaID = $_POST['id'];

                    $qryDeletePiloto = "DELETE FROM pilotos_has_noticias WHERE piloto='$pilotoID' AND noticia='$noticiaID'";
                    $rtaDeletePiloto = mysqli_query($cnx, $qryDeletePiloto);

                    if($rtaDeletePiloto){
                        echo 'hecho';
                    }else{
                        echo 'fallo';
                    }
                }

            }

        }

        echo $changes;

    }

    /*------------------------*/

    $qryPilotos = "SELECT id, nombre FROM pilotos";
    $rtaPilotos = mysqli_query($cnx, $qryPilotos);

    $pilotos = [];

    while($row = mysqli_fetch_assoc($rtaPilotos)){
        array_push($pilotos, $row);
    }


    $qryPilotosNoticias = "SELECT id, piloto, noticia FROM pilotos_has_noticias";
    $rtaPilotosNoticias = mysqli_query($cnx, $qryPilotosNoticias);

    $pilotosNoticias = [];

    while($row = mysqli_fetch_assoc($rtaPilotosNoticias)){
        array_push($pilotosNoticias, $row);
    }

    print_r($pilotosNoticias);

    $qryMarcas = "SELECT id, nombre FROM marcas";
    $rtaMarcas = mysqli_query($cnx, $qryMarcas);

    $marcas = [];

    while($row = mysqli_fetch_assoc($rtaMarcas)){
        array_push($marcas, $row);
    }

    $qryMarcasNoticias = "SELECT id, marca, noticia FROM marcas_has_noticias";
    $rtaMarcasNoticias = mysqli_query($cnx, $qryMarcasNoticias);

    $marcasNoticias = [];

    while($row = mysqli_fetch_assoc($rtaMarcasNoticias)){
        array_push($marcasNoticias, $row);
    }

    if(isset($_POST['id'])){

    }

    for ($i=0; $i < count($resultado); $i++) { 
     
        echo '<div>';

        echo '<form method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id" value="'. $resultado[$i]['id']. '"/>';
            echo '<input type="hidden" name="indice" value="'.$i. '"/>';
            echo '<input type="file" name="foto"/>';
            echo '<input type="text" name="titulo" value="'. $resultado[$i]['titulo'] .'"/>';
            echo '<input type="text" name="descripcion" value="'. $resultado[$i]['descripcion'] .'"/>';
            echo '<input type="date" name="fecha" value="'. $resultado[$i]['fecha'] .'"/>';
            echo '<input type="text" name="link" value="'. $resultado[$i]['link'] .'"/>';
            echo '<div>';

                $pilotoRepe =[];
                for ($j=0; $j < count($pilotos); $j++) { 

                    for ($a=0; $a < count($pilotosNoticias); $a++) { 
                        
                        if($pilotos[$j]['id'] == $pilotosNoticias[$a]['piloto'] && $resultado[$i]['id'] == $pilotosNoticias[$a]['noticia']){
                            echo '<input type="checkbox" name="pilotosNoticias[]" value="'.$pilotos[$j]['id'].'" id="piloto'.$pilotos[$j]['id'].'" checked />';
                            echo '<label for="piloto'.$pilotos[$j]['id'].'">'.$pilotos[$j]['nombre'].'</label>' ;
                            array_push($pilotoRepe, $pilotos[$j]['id']);
                        break;
                        }

                    }

                    if(!in_array($pilotos[$j]['id'], $pilotoRepe)){
                        echo '<input type="checkbox" name="pilotosNoticias[]" value="'.$pilotos[$j]['id'].'" id="piloto'.$pilotos[$j]['id'].'"/>';
                        echo '<label for="piloto'.$pilotos[$j]['id'].'">'.$pilotos[$j]['nombre'].'</label>' ;
                    }
                
                }
            echo '</div>';
            echo '<div>';

                $marcaRepe =[];
                for ($x=0; $x < count($marcas); $x++) { 

                    for ($a=0; $a < count($marcasNoticias); $a++) { 
                        
                        if($marcas[$x]['id'] == $marcasNoticias[$a]['marca'] && $resultado[$i]['id'] == $marcasNoticias[$a]['noticia']){
                            echo '<input type="checkbox" name="marcasNoticias[]" value="'.$marcas[$x]['id'].'" id="marca'.$marcas[$x]['id'].'" checked />';
                            echo '<label for="marca'.$marcas[$x]['id'].'">'.$marcas[$x]['nombre'].'</label>' ;
                            array_push($marcaRepe, $marcas[$x]['id']);
                        break;
                        }

                    }

                    if(!in_array($marcas[$x]['id'], $marcaRepe)){
                        echo '<input type="checkbox" name="marcasNoticias[]" value="'.$marcas[$x]['id'].'" id="marca'.$marcas[$x]['id'].'"/>';
                            echo '<label for="marca'.$marcas[$x]['id'].'">'.$marcas[$x]['nombre'].'</label>' ;
                    }
                
                }
            echo '</div>';
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        
    echo '</div>';
    }

?>