<?php

require_once("../config/config.php");

$id = $_POST['id'];
$link =$_POST['link'];

$qry = "DELETE FROM comentarios WHERE comentarios.id='$id'";

if(mysqli_query($cnx, $qry)){

    header('location:../index.php?seccion=inicio&noticia='.$link.'&estado=ok&mensaje=comentarioBorrado');

}else{

    header('location:../index.php?seccion=inicio&noticia='.$link.'&estado=error&mensaje=comentarioNoBorrado');

}