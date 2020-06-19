<?php

if(isset($_POST['id'])){

    $pilotoID = $_POST['id'];
    $changes = '';
    isset($_FILES['imagen'])?$imagen =$_FILES['imagen']:'';
    isset($_FILES['casco'])?$casco =$_FILES['casco']:'';
    isset($_FILES['imagen']['name'])?$nombreImagen =$_FILES['imagen']['name']:'';
    isset($_FILES['casco']['name'])?$nombreCasco =$_FILES['casco']['name']:'';

    if(isset($_POST['borrar'])){

        echo $pilotoID;
        
        $qryBorrarPiloto = "DELETE FROM pilotos WHERE id=$pilotoID";
        $rtaBorrarPiloto = mysqli_query($cnx, $qryBorrarPiloto);
    
        if($rtaBorrarPiloto){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=ok&mensaje=datoBorrado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=datoNoBorrado');
            die();
        }
    }

    if(!empty($nombreImagen)){
        
        if($imagen['type'] != "image/png"){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=typeImg');
            die();
        }

        if($imagen['size'] > 1048576){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=tamañoImg');
            die();
        }
        
        $rtaImagen = move_uploaded_file($imagen['tmp_name'], "img/pilotos/$nombreImagen");

        if($rtaImagen){
            if(strlen($changes) == 0){
                $changes = 'imagen="'.$nombreImagen.'"';
            }else{
                $changes = $changes.', imagen="'.$nombreImagen.'"';
            }
        }else{
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=problemaImg');
            die();
        }
    }

    if(!empty($nombreCasco)){
        
        if($casco['type'] != "image/png"){
            print_r($casco);
            die();
        }

        if($casco['size'] > 1048576){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=tamañoImg');
            die();
        }
        
        $rtaCasco = move_uploaded_file($casco['tmp_name'], "img/pilotos/cascos/$nombreCasco");

        if($rtaCasco){
            if(strlen($changes) == 0){
                $changes = 'casco="'.$nombreCasco.'"';
            }else{
                $changes = $changes.', casco="'.$nombreCasco.'"';
            }
        }else{
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=problemaImg');
            die();
        }
        
    }

    if(isset($_POST['nombre']) && $_POST['nombre'] != $resultado[$_POST['indice']]['nombre']){

        if(strlen($_POST['nombre']) > 60){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'nombre="'.$_POST['nombre'].'"';
        }else{
            $changes = $changes.', nombre="'.$_POST['nombre'].'"';
        }

    }


    if(isset($_POST['biografia']) && $_POST['biografia'] != $resultado[$_POST['indice']]['biografia']){

        if(strlen($_POST['biografia']) > 21000){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'biografia="'.$_POST['biografia'].'"';
        }else{
            $changes = $changes.', biografia="'.$_POST['biografia'].'"';
        }

    }

    if(isset($_POST['equipo']) && $_POST['equipo'] != $resultado[$_POST['indice']]['equipo']){

        if(strlen($_POST['equipo']) > 60){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'equipo="'.$_POST['equipo'].'"';
        }else{
            $changes = $changes.', equipo="'.$_POST['equipo'].'"';
        }

    }

    if(isset($_POST['nacimiento']) && $_POST['nacimiento'] != $resultado[$_POST['indice']]['nacimiento']){

        if(strlen($changes) == 0){
            $changes = 'nacimiento="'.$_POST['nacimiento'].'"';
        }else{
            $changes = $changes.', nacimiento="'.$_POST['nacimiento'].'"';
        }

    }

    if(isset($_POST['edad']) && $_POST['edad'] != $resultado[$_POST['indice']]['edad']){

        echo $_POST['edad'];

        if(intval($_POST['edad']) < 15 || intval($_POST['edad']) > 60){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=problemaEdad');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'edad="'.$_POST['edad'].'"';
        }else{
            $changes = $changes.', edad="'.$_POST['edad'].'"';
        }

    }

    if(isset($_POST['numero']) && $_POST['numero'] != $resultado[$_POST['indice']]['numero']){

        if($_POST['numero'] <1 || $_POST['numero'] > 999){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=problemaNumero');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'numero="'.$_POST['numero'].'"';
        }else{
            $changes = $changes.', numero="'.$_POST['numero'].'"';
        }

    }

    if(isset($_POST['link']) && $_POST['link'] != $resultado[$_POST['indice']]['link']){

        if(strlen($_POST['link']) > 50){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=excedeLargo');
            die();
        }

        if(strlen($changes) == 0){
            $changes = 'link="'.$_POST['link'].'"';
        }else{
            $changes = $changes.', link="'.$_POST['link'].'"';
        }

    }

    if(isset($_POST['marca']) && $_POST['marca'] != $resultado[$_POST['indice']]['marca']){

        if(strlen($changes) == 0){
            $changes = 'marca="'.$_POST['marca'].'"';
        }else{
            $changes = $changes.', marca="'.$_POST['marca'].'"';
        }

    }

    if(strlen($changes) >= 3){
        $qry = "UPDATE pilotos SET $changes WHERE id='$pilotoID'";
        $rta = mysqli_query($cnx, $qry);

        if($rta){
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=ok&mensaje=datoActualizado');
            die();
        }else{
            header('location:panel.php?seccion=panelcrud&edit=pilotos&estado=error&mensaje=datoNoActualizado');
            die();
        }
    }

    echo $changes;

}

/*----------------------------------------------------------------------*/

$qryMarca = "SELECT id, nombre FROM marcas";
$rtaMarca = mysqli_query($cnx, $qryMarca);

$marcas =[];

while($row = mysqli_fetch_assoc($rtaMarca)){

    array_push($marcas,$row);
}


for ($i=0; $i < count($resultado); $i++) { 

    echo '<div class="cardEdit" >';
        echo '<form method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id" value="'. $resultado[$i]['id']. '"/>';
            echo '<input type="hidden" name="indice" value="'.$i. '"/>';
            echo '<p>Imagen de perfil</p>';
            echo '<input type="file" name="imagen"/>';
            echo '<p>Nombre</p>';
            echo '<input type="text" name="nombre" value="'. $resultado[$i]['nombre'] .'"/>';
            echo '<p>Biografia</p>';
            echo '<input type="text" name="biografia" value="'. $resultado[$i]['biografia'] .'"/>';
            echo '<p>Equipo</p>';
            echo '<input type="text" name="equipo" value="'. $resultado[$i]['equipo'] .'"/>';
            echo '<p>Nacimiento</p>';
            echo '<input type="date" name="nacimiento" value="'. $resultado[$i]['nacimiento'] .'"/>';
            echo '<p>Edad</p>';
            echo '<input type="number" name="edad" value="'. $resultado[$i]['edad'] .'"/>';
            echo '<p>Numero</p>';
            echo '<input type="number" name="numero" value="'. $resultado[$i]['numero'] .'"/>';
            echo '<p>Link</p>';
            echo '<input type="text" name="link" value="'. $resultado[$i]['link'] .'"/>';
            echo '<p>Marca</p>';
            echo '<select name="marca">';
            
                for ($j=0; $j < count($marcas); $j++) { 
                    
                    if($marcas[$j]['id'] == $resultado[$i]['marca']){
                        echo '<option value="'. $marcas[$j]['id'] .'" selected="true">'. $marcas[$j]['nombre'] .'</option>';
                    }else{
                        echo '<option value="'. $marcas[$j]['id'] .'">'. $marcas[$j]['nombre'] .'</option>';
                    }

                }

            echo '</select>';
            echo '<p>Foto del casco</p>';
            echo '<input type="file" name="casco"/>';
            echo '<input type="submit" value="Guardar"/>';
        echo '</form>';

        echo '<form method="post">';
            echo '<input type="hidden" value="'. $resultado[$i]['id'] .'" name="id"/>';
            echo '<input type="hidden" value="1" name="borrar"/>';
            echo '<input type="submit" value="Borrar"/>';
        echo '</form>';
    echo '</div>';

}

?>