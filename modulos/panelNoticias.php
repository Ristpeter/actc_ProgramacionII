
<?php

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

  /*------------------------*/

    if(isset($_POST['id'])){

        $changes = '';
        $img =$_FILES['foto'];
        $nombreImg = $_FILES['foto']['name'];

        if(!empty($img['name'])){
            
            if($img['type'] != "image/png"){
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=typeImg');
                die();
            }

            if($img['size'] > 1048576){
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=tamañoImg');
                die();
            }
            
            $rtaImg = move_uploaded_file($img['tmp_name'], "img/noticias/$nombreImg");

            if($rtaImg){
                if(strlen($changes) == 0){
                    $changes = 'imagen="'.$nombreImg.'"';
                }else{
                    $changes = $changes.', imagen="'.$nombreImg.'"';
                }
            }else{
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=ocurrioProblema');
                die();
            }
        }

        if(isset($_POST['titulo']) && $_POST['titulo'] != $resultado[$_POST['indice']]['titulo']){

            if(strlen($_POST['titulo']) > 120){
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=excedeLargo');
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
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=excedeLargo');
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
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=excedeLargo');
                die();
            }

            if(strlen($changes) == 0){
                $changes = 'link="'.$_POST['link'].'"';
            }else{
                $changes = $changes.', link="'.$_POST['link'].'"';
            }

        }        
        $noticiasConPilotos = [];

        for ($x=0; $x < count($pilotosNoticias); $x++) { 
            if($pilotosNoticias[$x]['noticia'] == $_POST['id']){
                array_push($noticiasConPilotos, $pilotosNoticias[$x]['piloto']);
            }
        }
        

        $noticiasConMarcas = [];

        for ($z=0; $z < count($marcasNoticias); $z++) { 
            if($marcasNoticias[$z]['noticia'] == $_POST['id']){
                array_push($noticiasConMarcas, $marcasNoticias[$z]['marca']);
            }
        }


        $noticiaID = $_POST['id'];

        if(!isset($_POST['pilotosNoticias'])){
            $qryDelete = "DELETE FROM pilotos_has_noticias WHERE noticia='$noticiaID'";
            $rtaDelete = mysqli_query($cnx, $qryDelete);

            if(!$rtaDelete){
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoBorrado');
                die();
            }

        }else{

            $pilotoNot= $_POST['pilotosNoticias'];

            for ($l=0; $l < count($_POST['pilotosNoticias']) ; $l++) { 

                if(!in_array($pilotoNot[$l], $noticiasConPilotos)){
                    $qryInser = " INSERT INTO pilotos_has_noticias (piloto, noticia) VALUES ('$pilotoNot[$l]', '$noticiaID')";
                    $rtaInser = mysqli_query($cnx, $qryInser);

                    if(!$rtaInser){
                        header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoActualizado');
                        die();
                    }
                }
            }

            for ($p=0; $p < count($noticiasConPilotos) ; $p++) { 

                if(!in_array($noticiasConPilotos[$p], $pilotoNot)){
                    $qryDelete = "DELETE FROM pilotos_has_noticias WHERE noticia='$noticiaID' AND piloto='$noticiasConPilotos[$p]'";
                    $rtaDelete = mysqli_query($cnx, $qryDelete);

                    if(!$rtaDelete){
                        header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoBorrado');
                        die();
                    }
                }
            }

        }

        if(!isset($_POST['marcasNoticias'])){
            $qryDelete = "DELETE FROM marcas_has_noticias WHERE noticia='$noticiaID'";
            $rtaDelete = mysqli_query($cnx, $qryDelete);

            if(!$rtaDelete){
                header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoBorrado');
                die();
            }

            header('location:panel.php?seccion=panelcrud&edit=noticias&estado=ok&mensaje=datoActualizado');
            die();
        }else{

            $marcaNot= $_POST['marcasNoticias'];

            for ($l=0; $l < count($marcaNot) ; $l++) { 

                if(!in_array($marcaNot[$l], $noticiasConMarcas)){
                    $qryInser = " INSERT INTO marcas_has_noticias (marca, noticia) VALUES ('$marcaNot[$l]', '$noticiaID')";
                    $rtaInser = mysqli_query($cnx, $qryInser);

                    if(!$rtaInser){
                        header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoActualizado');
                        die();
                    }
                }
            }

            for ($p=0; $p < count($noticiasConMarcas) ; $p++) { 

                if(!in_array($noticiasConMarcas[$p], $marcaNot)){
                    $qryDelete = "DELETE FROM marcas_has_noticias WHERE noticia='$noticiaID' AND marca='$noticiasConMarcas[$p]'";
                    $rtaDelete = mysqli_query($cnx, $qryDelete);

                    if(!$rtaDelete){
                        header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoBorrado');
                        die();
                    }
                }
            }

            if(strlen($changes) > 3){

                $id = $_POST['id'];

                $qry = "UPDATE noticias SET $changes WHERE id=$id";
                $rta = mysqli_query($cnx, $qry);

                if($rta){
                    header('location:panel.php?seccion=panelcrud&edit=noticias&estado=ok&mensaje=datoActualizado');
                    die();
                }else{
                    header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoActualizado');
                    die();
                }


            }

        }

    }else if(isset($_POST['borrar'])){
        $id = $_POST['idBorrar'];

        $qryBorrar = "DELETE FROM noticias WHERE id='$id'";
        $rtaBorrar = mysqli_query($cnx, $qryBorrar);

        if(!$rtaBorrar){
            header('location:panel.php?seccion=panelcrud&edit=noticias&estado=error&mensaje=datoNoBorrado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=noticias&estado=ok&mensaje=datoBorrado');
            die();
        }
    }


    for ($i=0; $i < count($resultado); $i++) { 
     
        echo '<div class="cardEdit">';

        echo '<form method="post" enctype="multipart/form-data">';
        
            echo '<input type="hidden" name="id" value="'. $resultado[$i]['id']. '"/>';
            echo '<input type="hidden" name="indice" value="'.$i. '"/>';
            echo '<p>Foto de noticia</p>';
            echo '<input type="file" name="foto"/>';
            echo '<p>Titulo</p>';
            echo '<input type="text" name="titulo" value="'. $resultado[$i]['titulo'] .'"/>';
            echo '<p>Descripcion</p>';
            echo '<input type="text" name="descripcion" value="'. $resultado[$i]['descripcion'] .'"/>';
            echo '<p>Fecha</p>';
            echo '<input type="date" name="fecha" value="'. $resultado[$i]['fecha'] .'"/>';
            echo '<p>Link de la noticia</p>';
            echo '<input type="text" name="link" value="'. $resultado[$i]['link'] .'"/>';
            echo '<div class="gridNN">';
            echo '<div>';
            echo '<p>Pilotos que aparecen</p>';
            echo '<div id="selectNN">';

                $pilotoRepe =[];
                for ($j=0; $j < count($pilotos); $j++) { 

                    for ($a=0; $a < count($pilotosNoticias); $a++) { 
                        
                        if($pilotos[$j]['id'] == $pilotosNoticias[$a]['piloto'] && $resultado[$i]['id'] == $pilotosNoticias[$a]['noticia']){
                            echo '<div>';
                            echo '<input type="checkbox" name="pilotosNoticias[]" value="'.$pilotos[$j]['id'].'" id="piloto'.$i.$pilotos[$j]['id'].'" checked />';
                            echo '<label for="piloto'.$i.$pilotos[$j]['id'].'">'.$pilotos[$j]['nombre'].'</label>' ;
                            echo '</div>';
                            array_push($pilotoRepe, $pilotos[$j]['id']);
                        break;
                        }

                    }

                    if(!in_array($pilotos[$j]['id'], $pilotoRepe)){
                        echo '<div>';
                        echo '<input type="checkbox" name="pilotosNoticias[]" value="'.$pilotos[$j]['id'].'" id="piloto'.$i.$pilotos[$j]['id'].'"/>';
                        echo '<label for="piloto'.$i.$pilotos[$j]['id'].'">'.$pilotos[$j]['nombre'].'</label>' ;
                        echo '</div>';
                    }
                
                }
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<p>Marcas que aparecen</p>';
            echo '<div id="selectNN">';

                $marcaRepe =[];
                for ($x=0; $x < count($marcas); $x++) { 

                    for ($a=0; $a < count($marcasNoticias); $a++) { 
                        
                        if($marcas[$x]['id'] == $marcasNoticias[$a]['marca'] && $resultado[$i]['id'] == $marcasNoticias[$a]['noticia']){
                            echo '<div>';
                            echo '<input type="checkbox" name="marcasNoticias[]" value="'.$marcas[$x]['id'].'" id="marca'.$i.$marcas[$x]['id'].'" checked />';
                            echo '<label for="marca'.$i.$marcas[$x]['id'].'">'.$marcas[$x]['nombre'].'</label>' ;
                            echo '</div>';
                            array_push($marcaRepe, $marcas[$x]['id']);
                        break;
                        }

                    }

                    if(!in_array($marcas[$x]['id'], $marcaRepe)){
                        echo '<div>';
                        echo '<input type="checkbox" name="marcasNoticias[]" value="'.$marcas[$x]['id'].'" id="marca'.$i.$marcas[$x]['id'].'"/>';
                            echo '<label for="marca'.$i.$marcas[$x]['id'].'">'.$marcas[$x]['nombre'].'</label>' ;
                        echo '</div>';
                    }
                
                }
            echo '</div>';
            echo '</div>';

            echo '</div>';
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        echo '<form method="post">';
            echo '<input type="hidden" name="idBorrar" value="'. $resultado[$i]['id']. '"/>';
            echo '<input type="hidden" name="borrar" value="1"/>';
            echo '<input type="submit" value="Borrar"/>';
        echo '</form>';

        
    echo '</div>';
    }

?>