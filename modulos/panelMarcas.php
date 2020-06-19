<?php

if(isset($_POST['id'])){

    $marcaID = $_POST['id'];
    $changes = '';
    isset($_FILES['imagen'])?$imagen =$_FILES['imagen']:'';
    isset($_FILES['imagen']['name'])?$nombreImagen =$_FILES['imagen']['name']:'';

    if(!empty($nombreImagen)){

        if($imagen['type'] != "image/png"){
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=typeImg');
            die();
        }

        if($imagen['size'] > 1048576){
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=tamañoImg');
            die();
        }
        
        $rtaImagen = move_uploaded_file($imagen['tmp_name'], "img/marcas/$nombreImagen");

        if($rtaImagen){
            if(strlen($changes) == 0){
                $changes = 'imagen="'.$nombreImagen.'"';
            }else{
                $changes = $changes.', imagen="'.$nombreImagen.'"';
            }
        }else{
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=problemaImg');
            die();
        }
    }

    if(isset($_POST['nombre']) && $_POST['nombre'] != $resultado[$_POST['indice']]['nombre']){

        if($_POST['nombre'] > 80){
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'nombre="'.$_POST['nombre'].'"';
        }else{
            $changes = $changes.', nombre="'.$_POST['nombre'].'"';
        }

    }

    if(isset($_POST['biografia']) && $_POST['biografia'] != $resultado[$_POST['indice']]['biografia']){

        if($_POST['biografia'] > 80){
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'biografia="'.$_POST['biografia'].'"';
        }else{
            $changes = $changes.', biografia="'.$_POST['biografia'].'"';
        }

    }


    if(strlen($changes) > 3){
        $qry = "UPDATE marcas SET $changes WHERE id=$marcaID";
        $rta = mysqli_query($cnx,$qry);

        if($rta){
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=ok&mensaje=datoActualizado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=datoNoActualizado');
            die();
        }
    }
    

}

if(isset($_POST['borrar'])){
    $marcaBorrarID = $_POST['idBorrar'];
        
    $qryBorrarMarca = "DELETE FROM marcas WHERE id=$marcaBorrarID";
    $rtaBorrarMarca = mysqli_query($cnx, $qryBorrarMarca);

    if($rtaBorrarMarca){
        header('location:panel.php?seccion=panelcrud&edit=marcas&estado=ok&mensaje=datoBorrado');
        die();
    }else{
        header('location:panel.php?seccion=panelcrud&edit=marcas&estado=error&mensaje=datoNoBorrado');
        die();
    }

    
}

for ($i=0; $i < count($resultado); $i++) { 

    echo '<div class="cardEdit">';
        echo '<form method="post" enctype="multipart/form-data">';

            echo '<input type="hidden" name="id" value="'. $resultado[$i]['id']. '"/>';
            echo '<input type="hidden" name="indice" value="'.$i. '"/>';
            echo '<p>Imagen</p>';
            echo '<input type="file" name="imagen"/>';
            echo '<p>Nombre</p>';
            echo '<input type="text" name="nombre" value="'. $resultado[$i]['nombre'] .'"/>';
            echo '<p>Biografia</p>';
            echo '<input type="text" name="biografia" value="'. $resultado[$i]['biografia'] .'"/>';
            
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        echo '<form method="post">';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="idBorrar"/>';
            echo '<input type="hidden" value="1" name="borrar"/>';
            echo '<input type="submit" value="Borrar"/>';
        echo '</form>';
    echo '</div>';

}

?>