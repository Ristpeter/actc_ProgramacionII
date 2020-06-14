<?php

require('../config/config.php');

print_r($_POST);

echo '<p>-------------------------</p>';    

if(isset($_POST['isAdmin'])){
    
}else if(isset($_POST['Voto'])){

}else{

    $tabla = $_POST['table'];
    $id = $_POST['id'];

    $qryValidacion="SELECT * FROM $tabla WHERE id=$id";
    $rtaValidacion=mysqli_query($cnx,$qryValidacion);

    $validacion = [];

    while($row = mysqli_fetch_assoc($rtaValidacion)){
        array_push($validacion,$row);
    }

    $changes=[];
    
    foreach ($_POST as $key => $value) {
        
        if($_POST[$key] != $validacion[0][$key]){
            array_push($changes, $key);
        }

    }

}


print_r($validacion[0]);

echo '<p>-----------------------------------------</p>';

print_r($changes);

?>