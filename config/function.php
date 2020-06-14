<?php


function onSession(){

    return isset($_SESSION["usuario"]);

}

function endSession(){
    session_destroy();
}