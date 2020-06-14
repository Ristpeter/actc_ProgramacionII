<?php

require('../config/config.php');

$keys= array_keys($_POST);

$key = $keys[0];
$userID = $_SESSION['usuario']['id'];
$value=$_POST[$keys[0]];

print_r($userID);

if($key == 'icono' && $_SESSION['datos']['marcasID'] != $_POST[$keys[0]]){

    $qry = "UPDATE usuarios SET icono='$_POST[icono]' WHERE usuarios.id='$userID';";

    $rta = mysqli_query($cnx,$qry);

    $_SESSION['usuario']['icono'] = $_POST['icono'];

    switch ($_POST['icono']) {
        case 1:
            $_SESSION['datos']['marcasID'] = 1;
            $_SESSION['datos']['marcaNombre'] = 'Chevrolet';
            $_SESSION['datos']['marcaImagen'] = 'chevroletLogo.png';
            break;

        case 2:
            $_SESSION['datos']['marcasID'] = 2;
            $_SESSION['datos']['marcaNombre'] = 'Ford';
            $_SESSION['datos']['marcaImagen'] = 'fordLogo.png';
            break;

        case 3:
            $_SESSION['datos']['marcasID'] = 3;
            $_SESSION['datos']['marcaNombre'] = 'Torino';  
            $_SESSION['datos']['marcaImagen'] = 'torinoLogo.png';
            break;

        case 4:
            $_SESSION['datos']['marcasID'] = 4;
            $_SESSION['datos']['marcaNombre'] = 'Dodge';               
            $_SESSION['datos']['marcaImagen'] = 'dodgeLogo.png';
            break;
        
        default:
            die();
            break;
    }

    $newSESSION[0] = $_SESSION['usuario'];
    $newSESSION[1] = $_SESSION['datos'];

    session_destroy();

    session_start();

    $_SESSION["usuario"] = $newSESSION[0];
    $_SESSION["datos"] = $newSESSION[1];

    header("Location:../?seccion=perfil");

}else if($key == 'piloto' && $_SESSION['datos']['pilotoID'] != $_POST[$keys[0]]){

    $qry = "UPDATE usuarios SET piloto_id='$_POST[piloto]' WHERE usuarios.id='$userID';";

    $rta = mysqli_query($cnx,$qry);

    $qryPiloto = "SELECT id, nombre, casco FROM pilotos WHERE id=$value;";

    $rtaPiloto = mysqli_query($cnx,$qryPiloto);

    $piloto = mysqli_fetch_assoc($rtaPiloto);

    $_SESSION['usuario']['piloto_id'] = $piloto['id'];
    $_SESSION['datos']['pilotoID'] = $piloto['id'];
    $_SESSION['datos']['pilotoNombre'] = $piloto['nombre'];
    $_SESSION['datos']['pilotoImagen'] = $piloto['casco'];


    $newSESSION[0] = $_SESSION['usuario'];
    $newSESSION[1] = $_SESSION['datos'];

    session_destroy();

    session_start();

    $_SESSION["usuario"] = $newSESSION[0];
    $_SESSION["datos"] = $newSESSION[1];

    header("Location:../?seccion=perfil");

}else if($key == 'usuario'  && $_SESSION['usuario']['usuario'] != $_POST[$keys[0]] && $_POST['usuario'] !== "" && strlen($_POST['usuario']) < 40){

    $a = $_POST['usuario'];

    $qryValidacion = "SELECT usuario FROM usuarios WHERE usuario='$a';";

    $rtaValidacion = mysqli_query($cnx, $qryValidacion);

    if($rtaValidacion == true){

        $qry = "UPDATE usuarios SET usuario='$a' WHERE usuarios.id='$userID';";

            if($rta = mysqli_query($cnx, $qry)){

            $_SESSION['usuario']['usuario'] = $a;


            $newSESSION[0] = $_SESSION['usuario'];
            $newSESSION[1] = $_SESSION['datos'];

            session_destroy();

            session_start();

            $_SESSION["usuario"] = $newSESSION[0];
            $_SESSION["datos"] = $newSESSION[1];

            header("Location:../?seccion=perfil");

        }else{
            header("Location:../?seccion=perfil&estadp=error");
        }

    }else{
        echo 'ya existe';
    }


}else if($key == 'nombre'  && $_SESSION['usuario']['nombre'] != $_POST[$keys[0]] && $_POST['nombre'] !== "" && strlen($_POST['nombre']) < 40){

    $a = $_POST['nombre'];

    $qry = "UPDATE usuarios SET nombre='$a' WHERE usuarios.id='$userID';";

    if($rta = mysqli_query($cnx, $qry)){

        $_SESSION['usuario']['nombre'] = $a;


        $newSESSION[0] = $_SESSION['usuario'];
        $newSESSION[1] = $_SESSION['datos'];

        session_destroy();

        session_start();

        $_SESSION["usuario"] = $newSESSION[0];
        $_SESSION["datos"] = $newSESSION[1];

        header("Location:../?seccion=perfil");

    }else{
        header("Location:../?seccion=perfil&estadp=error");
    }

}else if($key == 'apellido'  && $_SESSION['usuario']['apellido'] != $_POST[$keys[0]] && $_POST['apellido'] !== "" && strlen($_POST['apellido']) < 40){

    $a = $_POST['apellido'];

    $qry = "UPDATE usuarios SET apellido='$a' WHERE usuarios.id='$userID';";

    if($rta = mysqli_query($cnx, $qry)){

        $_SESSION['usuario']['apellido'] = $a;


        $newSESSION[0] = $_SESSION['usuario'];
        $newSESSION[1] = $_SESSION['datos'];

        session_destroy();

        session_start();

        $_SESSION["usuario"] = $newSESSION[0];
        $_SESSION["datos"] = $newSESSION[1];

        header("Location:../?seccion=perfil");

    }else{
        header("Location:../?seccion=perfil&estadp=error");
    }

}

else if($key == 'email'  && $_SESSION['usuario']['email'] != $_POST[$keys[0]] && $_POST['email'] !== "" && strlen($_POST['email']) < 100){

    $a = $_POST['email'];

    $qryValidacion = "SELECT email FROM usuarios WHERE email='$a';";

    $rtaValidacion = mysqli_query($cnx, $qryValidacion);

    if($rtaValidacion == true){

        $qry = "UPDATE usuarios SET email='$a' WHERE usuarios.id='$userID';";

            if($rta = mysqli_query($cnx, $qry)){

            $_SESSION['usuario']['email'] = $a;


            $newSESSION[0] = $_SESSION['usuario'];
            $newSESSION[1] = $_SESSION['datos'];

            session_destroy();

            session_start();

            $_SESSION["usuario"] = $newSESSION[0];
            $_SESSION["datos"] = $newSESSION[1];

            header("Location:../?seccion=perfil");

        }else{
            header("Location:../?seccion=perfil&estadp=error");
        }

    }else{
        echo 'ya existe';
    }


}else if($key == 'contraseña' && $_POST['contraseña'] === $_POST['confirmarContraseña'] && strlen($_POST['contraseña']) >= 8 && strlen($_POST['contraseña']) <= 40){

    $a = $_POST['contraseña'];

    $a = password_hash($a, PASSWORD_DEFAULT);

    $qry = "UPDATE usuarios SET contraseña='$a' WHERE usuarios.id='$userID';";

    if($rta = mysqli_query($cnx, $qry)){

        $_SESSION['usuario']['contraseña'] = $a;


        $newSESSION[0] = $_SESSION['usuario'];
        $newSESSION[1] = $_SESSION['datos'];

        session_destroy();

        session_start();

        $_SESSION["usuario"] = $newSESSION[0];
        $_SESSION["datos"] = $newSESSION[1];

        header("Location:../?seccion=perfil");

    }else{
        header("Location:../?seccion=perfil&estadp=error");
    }

}else if($key == 'nacimiento' && !empty($_POST['nacimiento']) && strtotime($_POST["nacimiento"]) > strtotime("01-01-1900") && strtotime($_POST["nacimiento"]) < strtotime("01-01-2020")){
    
    $a = $_POST['nacimiento'];

    $qry = "UPDATE usuarios SET nacimiento='$a' WHERE usuarios.id='$userID';";

    if($rta = mysqli_query($cnx, $qry)){

        $_SESSION['usuario']['nacimiento'] = $a;


        $newSESSION[0] = $_SESSION['usuario'];
        $newSESSION[1] = $_SESSION['datos'];

        session_destroy();

        session_start();

        $_SESSION["usuario"] = $newSESSION[0];
        $_SESSION["datos"] = $newSESSION[1];

        header("Location:../?seccion=perfil");

    }else{
        header("Location:../?seccion=perfil&estadp=error");
    }

}else{

    echo 'cagaste';
}




