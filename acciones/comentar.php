<?php

require_once("../config/config.php");

print_r($_POST);

print_r($_SESSION);

$comentario = $_POST['comentario'];
$fecha = date("Y-m-d");
$usuario_id = $_SESSION['usuario']['id'];
$noticia_id = $_POST['noticiaID'];

$link = $_POST['link'];

print_r($comentario);
print_r($fecha);
print_r($usuario_id);
print_r($noticia_id);


$qryComentar ="INSERT INTO comentarios (comentario, fecha, usuario_id, noticia_id) VALUES ('$comentario', '$fecha', '$usuario_id', '$noticia_id');";

    $rtaComentar = mysqli_query($cnx, $qryComentar);

    if(!$rtaComentar){
        header("Location: ../index.php?seccion=inicio&noticia=". $link."&err=err");
        die();
    }else{
        header("Location: ../index.php?seccion=inicio&noticia=".$link."&ok=ok");
    }