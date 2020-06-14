<?php

require_once("../config/config.php");

if(empty($_POST["usuario"]) || empty($_POST["contraseña"])){
    header("Location:../index.php?seccion=login&err=err&msj=obligatorios");
    die();
}

$usuario = $_POST["usuario"];
$columna = "usuario";


if(strpos($usuario,"@") !== false){

    if(!filter_var($usuario, FILTER_VALIDATE_EMAIL)){
        header("Location: ../index.php?seccion=login&err=err&msj=email");
        die();
    }
    $columna = "email";
    
}

$qryLogin = "SELECT usuarios.* FROM usuarios WHERE $columna='$usuario'";

$rtaLogin = mysqli_query($cnx,$qryLogin);

if(mysqli_num_rows($rtaLogin) == 0){

    header("Location: ../?seccion=login&estado=error&mensaje=registro");
    die();

}

$userLogin = mysqli_fetch_assoc($rtaLogin);

if(!password_verify($_POST['contraseña'], $userLogin['contraseña'])){
    
    header("Location: ../?seccion=login&estado=error&mensaje=login");
    die();

}

$_SESSION["usuario"] = $userLogin;
print_r($_SESSION['usuario']);

$qryDatos = "SELECT marcas.id AS marcasID, marcas.nombre AS marcaNombre, marcas.imagen AS marcaImagen, pilotos.id AS pilotoID, pilotos.nombre AS pilotoNombre, pilotos.casco AS pilotoCasco FROM marcas, pilotos WHERE marcas.id='$userLogin[icono]' AND pilotos.id='$userLogin[piloto_id];'";
$rtaDatos = mysqli_query($cnx, $qryDatos);

$_SESSION["usuario"] = $userLogin;

$datosLogin = mysqli_fetch_assoc($rtaDatos);
$_SESSION["datos"] = $datosLogin;


header("Location:../index.php");




