<?php

if(!isset($_SESSION['usuario']['id'])){
    session_start();

}




$sv = "localhost";
$usr = "root";
$pass = "";
$db = "automovilismo";

$cnx = mysqli_connect($sv, $usr, $pass, $db);