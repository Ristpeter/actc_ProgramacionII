<?php

    if(isset($_POST['crear'])){

    $imagen =$_FILES['imagen'];
    $nombreImagen = $imagen['name'];

        if(!empty($nombreImagen)){
            
            if($imagen['type'] != "image/png"){
                header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=typeImg');
                die();
            }

            if($imagen['size'] > 1048576){
                header('location:panel.php?seccion=crear&edit=noticias&estado=error&mensaje=tamañoImg');
                die();
            }
        
            $rtaImg = move_uploaded_file($imagen['tmp_name'], "img/marcas/$nombreImagen");

            if(!$rtaImg){
                header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=problemaImg');
                die();
            }
        }else{
            header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=imagenFaltante');
                die();
        }

        if(!(isset($_POST['nombre']) && strlen($_POST['nombre']) > 1 && strlen($_POST['nombre']) < 80)){
            header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=excedeLargo');
            die();
        }

        if(!(isset($_POST['biografia']) && strlen($_POST['biografia']) > 1 && strlen($_POST['biografia']) < 21000)){
            
            header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=excedeLargo');
            die();
        }


        $nombre = $_POST['nombre'];
        $biografia = $_POST['biografia'];
    
    
        $qryCrear = "INSERT INTO marcas (nombre, biografia, imagen) VALUES('$nombre', '$biografia', '$nombreImagen')";
        $rtaCrear = mysqli_query($cnx, $qryCrear);

        if(!$rtaCrear){
            header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=datoNoActualizado');
            die();
        }else{
            header('location:panel.php?seccion=crear&edit=marcas&estado=error&mensaje=datoActualizado');
            die();
        }

    }

?>

<div class="cardEdit">

<form method="POST" enctype="multipart/form-data">

    <input type="hidden" name="crear" value="1"/>

    <p>Foto de marca</p>
    <input type="file" name="imagen"/>

    <p>Nombre</p>
    <input type="text" name="nombre"/>

    <p>Biografia</p>
    <textarea name="biografia"></textarea>

    <input type="submit" value="Guardar"/>

</form>

</div>