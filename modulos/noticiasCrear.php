<?php

$qryPilotos = "SELECT id, nombre FROM pilotos";
$qryMarcas = "SELECT id, nombre FROM marcas";

$rtaPilotos = mysqli_query($cnx, $qryPilotos);
$rtaMarcas = mysqli_query($cnx, $qryMarcas);

$pilotos = [];
$marcas = [];

while($row = mysqli_fetch_assoc($rtaPilotos)){
    array_push($pilotos, $row);
}

while($row = mysqli_fetch_assoc($rtaMarcas)){
    array_push($marcas, $row);
}

if(isset($_POST['crear'])){

    
    $img =$_FILES['imagen'];
    $nombreImg = $img['name'];

    if(!empty($nombreImg)){
        
        if($img['type'] != "image/png"){
            header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=typeImg');
            die();
        }

        if($img['size'] > 1048576){
            header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=tamañoImg');
            die();
        }
     
        $rtaImg = move_uploaded_file($img['tmp_name'], "img/noticias/$nombreImg");

        if(!$rtaImg){
            header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=problemaImg');
            die();
        }
    }else{
        header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datosObligatorios');
        die();
    }

    if(!(isset($_POST['titulo']) && strlen($_POST['titulo']) > 1 && strlen($_POST['titulo']) < 120)){
        header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datosObligatorios');
        die();
    }

    if(!(isset($_POST['descripcion']) && strlen($_POST['descripcion']) > 1 && strlen($_POST['descripcion']) < 21000)){
        
        header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datosObligatorios');
        die();
    }


    if(!(isset($_POST['link']) && strlen($_POST['link']) > 1 && strlen($_POST['link']) < 80)){
        header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datosObligatorios');
        die();
    }else{

        $qryValidacion = "SELECT link FROM noticias";
        $rtaValidacion = mysqli_query($cnx, $qryValidacion);

        $links = [];

        while($row = mysqli_fetch_assoc($rtaValidacion)){
            array_push($links, $row);
        }

        for ($i=0; $i < count($links); $i++) { 
            if($links[$i]['link'] == $_POST['link']){
                header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=linkExistente');
                die();
            }
        }
    }

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = date('Y-m-d');
    $link = $_POST['link'];


    $qryCrear = "INSERT INTO noticias (titulo, descripcion, imagen, fecha, link) VALUES('$titulo', '$descripcion', '$nombreImg', '$fecha', '$link')";
    $rtaCrear = mysqli_query($cnx, $qryCrear);

    if(!$rtaCrear){
        header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=ocurrioProblema');
        die();
    }else{

        $qryBuscarID = "SELECT id FROM noticias WHERE link='$link'";
        $rtaBuscarID = mysqli_query($cnx, $qryBuscarID);

        $noticiaID = mysqli_fetch_assoc($rtaBuscarID);


        $insertNoticia = $noticiaID['id'];
        

        if(isset($_POST['pilotosNoticia'])){

            $insertPiloto = $_POST['pilotosNoticia']; 
        
            for ($s=0; $s < count($_POST['pilotosNoticia']); $s++) { 
                
                $qryNN = "INSERT INTO pilotos_has_noticias (piloto, noticia) VALUES ('$insertPiloto[$s]', '$insertNoticia')";
                $rtaNN = mysqli_query($cnx, $qryNN);

                if(!$rtaNN){
                    header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datoNoActualizado');
                    die();
                }

            }
        }
    
        
        if(isset($_POST['marcasNoticia'])){
            
            $insertMarca = $_POST['marcasNoticia']; 

            for ($s=0; $s < count($_POST['marcasNoticia']); $s++) { 
                
                $qryNN = "INSERT INTO marcas_has_noticias (marca, noticia) VALUES ('$insertMarca[$s]', '$insertNoticia')";
                $rtaNN = mysqli_query($cnx, $qryNN);

                if(!$rtaNN){
                    header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=datoNoActualizado');
                    die();
                }

            }
        }

        header('location:panel.php?seccion=crear&edit=noticias&estado=ok&mensaje=datoActualizado');
        die();
    }

}
?>

<div class="cardEdit">

<form method="POST" enctype="multipart/form-data">
    <input name="crear" type="hidden" value="1"/>
    <p>Imagen</p>
    <input type="file" name="imagen" />
    <p>Titulo</p>
    <input name="titulo" type="text"/>
    <p>Descripción</p>
    <textarea name="descripcion"></textarea>
    <p>Link</p>
    <input name="link" type="text"/>
    <p>Pilotos que aparecen</p>
    <div id="selectNN">
        <?php
            for ($x=0; $x < count($pilotos); $x++) { 
                echo '<div>';
                echo '<input type="checkbox" name="pilotosNoticia[]" value="'. $pilotos[$x]['id'] .'" id="piloto'.$pilotos[$x]['id'] .'" />';
                echo '<label for="piloto'. $pilotos[$x]['id'] .'">'. $pilotos[$x]['nombre'] .'</label>';
                echo '</div>';
            }
        ?>
    </div>
    <p>Marcas que aparecen</p>
    <div id="selectNN">
        <?php
            for ($j=0; $j < count($marcas); $j++) { 
                echo '<div>';
                echo '<input type="checkbox" name="marcasNoticia[]" value="'. $marcas[$j]['id'] .'" id="marca'.$marcas[$j]['id'] .'" />';
                echo '<label for="marca'. $marcas[$j]['id'] .'">'. $marcas[$j]['nombre'] .'</label>';
                echo '</div>';
            }
        ?>
    </div>
    <input type="submit" value="Guardar"/>

</form>

</div>