<?php

require('../config/config.php');

$voto = $_POST['id'];
$usr = $_SESSION['usuario']['id'];

if(!empty($_SESSION)){
    if($_SESSION['usuario']['Voto'] == 1){

        $qryVotacion = "UPDATE encuestas SET votos=votos+1 WHERE piloto='$voto';";

        if(mysqli_query($cnx, $qryVotacion)){

            $qryVotoEmitido = "UPDATE usuarios SET Voto=0 WHERE id='$usr';";
            mysqli_query($cnx,$qryVotoEmitido);
            $_SESSION['usuario']['Voto']=0;
            header('location:../?seccion=encuesta&estado=hecho');

        }else{

            header('location:../?seccion=encuesta&estado=ProblemaVoto');
        }

    }else{
        header('location:../?seccion=encuesta&estado=NoPodes');
    }
}else{
    header('location:../?seccion=login');
}
