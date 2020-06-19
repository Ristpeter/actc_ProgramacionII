<?php

$qryMarca = "SELECT * FROM marcas";
$rtaMarca = mysqli_query($cnx, $qryMarca);

$marcas = [];

while($row = mysqli_fetch_assoc($rtaMarca)){
    array_push($marcas, $row);
}

if(isset($_POST['crear'])){

    $perfil =$_FILES['perfil'];
    $nombrePerfil = $perfil['name'];
    $casco =$_FILES['casco'];
    $nombreCasco = $casco['name'];

    if(!empty($nombrePerfil)){
        
        if($perfil['type'] != "image/png"){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=typeImg');
            die();
        }

        if($perfil['size'] > 1048576){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=tamañoImg');
            die();
        }
     
        $rtaImg = move_uploaded_file($perfil['tmp_name'], "img/pilotos/$nombrePerfil");

        if(!$rtaImg){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=problemaImg');
            die();
        }
    }else{
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=datoObligatorioImagen');
        die();
    }

    if(!empty($nombreCasco)){
        
        if($casco['type'] != "image/png"){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=typeImg');
            die();
        }

        if($casco['size'] > 1048576){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=tamañoImg');
            die();
        }
     
        $rtaImg = move_uploaded_file($casco['tmp_name'], "img/pilotos/cascos/$nombreCasco");

        if(!$rtaImg){
            header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=problemaImg');
            die();
        }
    }else{
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=datoObligatorioCasco');
        die();
    }


    if(!(isset($_POST['nombre']) && strlen($_POST['nombre']) > 1 && strlen($_POST['nombre']) < 60)){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=excedeLargo');
        die();
    }

    if(!(isset($_POST['biografia']) && strlen($_POST['biografia']) > 1 && strlen($_POST['biografia']) < 21000)){
        
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=excedeLargo');
        die();
    }

    if(!(isset($_POST['equipo']) && strlen($_POST['equipo']) > 1 && strlen($_POST['equipo']) < 60)){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=excedeLargo');
        die();
    }

    if(!(isset($_POST['nacimiento']))){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=datoObligatorio');
        die();
    }

    if(!(isset($_POST['edad']) && $_POST['edad'] > 15 && $_POST['edad'] < 60)){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=problemaEdad');
        die();
    }

    if(!(isset($_POST['numero']) && $_POST['numero'] > 1 && $_POST['numero'] < 999)){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=problemaNumero');
        die();
    }

    if(!(isset($_POST['link']) && strlen($_POST['link']) > 1 && strlen($_POST['link']) < 50)){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=excedeLargo');
        die();
    }else{

        $qryValidacion = "SELECT link FROM pilotos";
        $rtaValidacion = mysqli_query($cnx, $qryValidacion);

        $links = [];

        while($row = mysqli_fetch_assoc($rtaValidacion)){
            array_push($links, $row);
        }

        for ($i=0; $i < count($links); $i++) { 
            if($links[$i]['link'] == $_POST['link']){
                header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=linkExistente');
                die();
            }
        }
    }

    $nombre = $_POST['nombre'];
    $biografia = $_POST['biografia'];
    $equipo = $_POST['equipo'];
    $nacimiento = $_POST['nacimiento'];
    $edad = $_POST['edad'];
    $numero = $_POST['numero'];
    $marca = $_POST['marca'];
    $link = $_POST['link'];
    
    $qryCrear = "INSERT INTO pilotos (nombre, biografia, equipo, imagen, nacimiento, edad, numero, casco, marca, link) VALUES('$nombre', '$biografia', '$equipo', '$nombrePerfil','$nacimiento', '$edad', '$numero', '$nombreCasco', '$marca', '$link')";
    $rtaCrear = mysqli_query($cnx, $qryCrear);

    if(!$rtaCrear){
        header('location:panel.php?seccion=crear&edit=pilotos&estado=error&mensaje=datoNoActualizado');
        die();
    }else{
        header('location:panel.php?seccion=crear&edit=pilotos&estado=ok&mensaje=datoActualizado');
        die();
    }

}


?>
<div class="cardEdit">
<form method="POST" enctype="multipart/form-data">

    <input name="crear" type="hidden" value="1"/>
    <p>Foto de perfil</p>
    <input type="file" name="perfil"/>
    <p>Foto del casco</p>
    <input type="file" name="casco"/>
    <p>Nombre</p>
    <input name="nombre" type="text"/>
    <p>Biografia</p>
    <textarea name="biografia"></textarea>
    <p>Equipo</p>
    <input name="equipo" type="text"/>
    <p>Nacimiento</p>
    <input name="nacimiento" type="date"/>
    <p>Edad</p>
    <input name="edad" type="number"/>
    <p>Numero</p>
    <input name="numero" type="number"/>
    <p>Marca</p>
    <?php
        echo '<select name="marca">';

        for ($i=0; $i < count($marcas) ; $i++) { 
            echo '<option value="'. $marcas[$i]['id'] .'">'. $marcas[$i]['nombre'] .'</option>';
        }

        echo '</select>';
    ?>
    <p>Link</p>
    <input name="link" type="text"/>
    <input type="submit" value="Guardar"/>

</form>

    </div>