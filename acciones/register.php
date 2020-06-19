<?php

require_once("../config/config.php");


if($_POST['usuario'] == null){
            
    header('location:../index.php?seccion=register&estado=error&mensaje=datoObligatorioUsuario');
    die();

}else if($_POST['nombre'] == null){
    
    header('location:../index.php?seccion=register&estado=error&mensaje=datoObligatorioNombre');
    die();

}else if($_POST['apellido'] == null){
    
    header('location:../index.php?seccion=register&estado=error&mensaje=datoObligatorioApellido');
    die();

}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    
    header('location:../index.php?seccion=register&estado=error&mensaje=emailInvalido');
    die();

}else if($_POST['contraseña'] == null){

    header('location:../index.php?seccion=register&estado=error&mensaje=datoObligatorioContraseña');
    die();

}else if($_POST['confirmarContraseña'] == null || $_POST['confirmarContraseña'] !== $_POST['contraseña']){

    header('location:../index.php?seccion=register&estado=error&mensaje=datoObligatorioConfirmarContraseña');
    die();

}else{

    $email = $_POST['email'];

    $qryEmail = "SELECT email FROM usuarios WHERE usuarios.email='$email';";

    $rtaEmail = mysqli_query($cnx, $qryEmail);
    
    if(mysqli_num_rows($rtaEmail) !== 0){

        header('location:../index.php?seccion=register&estado=error&mensaje=emailExistente');
        die();

    }

    $usr = $_POST['usuario'];

    $qryUsr = "SELECT usuario FROM usuarios WHERE usuarios.usuario='$usr';";

    $rtaUsr = mysqli_query($cnx, $qryUsr);
    
    if(mysqli_num_rows($rtaUsr) !== 0){
        
        header('location:../index.php?seccion=register&error=err&mensaje=usuarioExistente');
        die();

    }

    $password = $_POST["contraseña"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacimiento = $_POST['fecha'];
    $icono = $_POST['icono'];
    $piloto = $_POST['piloto'];

    $qryInsert = "INSERT INTO usuarios (usuario, nombre, apellido, email, contraseña, nacimiento, icono, piloto_id, Voto) VALUES ('$usr','$nombre','$apellido','$email','$password','$nacimiento','$icono','$piloto', 1);";

    $rtaInsert = mysqli_query($cnx, $qryInsert);

    if(!$rtaInsert){
        header("Location: ../index.php?seccion=register&estado=error&mensaje=noRegistro");
        die();
    }else{
        header("Location: ../index.php?seccion=login&estado=ok&mensaje=registro");
    }
}