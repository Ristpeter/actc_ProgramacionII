<?php

    $qryMarcas = "SELECT id, nombre, imagen FROM marcas;";

    $qryPilotos = "SELECT id, nombre FROM pilotos;"; 

    $rtaMarcas = mysqli_query($cnx,$qryMarcas);
    $rtaPilotos = mysqli_query($cnx,$qryPilotos);

    $img=[];
    $pilotos=[];

    while($row = mysqli_fetch_assoc($rtaMarcas)){
        array_push($img,$row);
    }

    while($row = mysqli_fetch_assoc($rtaPilotos)){
        array_push($pilotos,$row);
    }
 
    if(!empty($_POST)){

        if($_POST['usuario'] == null){
            
            header('location:?seccion=register&err=err&msj=usuario');

        }else if($_POST['nombre'] == null){
            
            header('location:?seccion=register&err=err&msj=nombre');

        }else if($_POST['apellido'] == null){
            
            header('location:?seccion=register&err=err&msj=apellido');

        }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
            header('location:?seccion=register&err=err&msj=email');

        }else if($_POST['contraseña'] == null){

            header('location:?seccion=register&err=err&msj=contraseña');

        }else if($_POST['confirmarContraseña'] == null || $_POST['confirmarContraseña'] !== $_POST['contraseña']){

            header('location:?seccion=register&err=err&msj=confirmarContraseña');

        }else{

            $qry = "INSERT INTO usuarios (usuario, nombre, apellido, email, contraseña, nacimiento, icono, piloto_id) VALUES ($_POST['usuario'],$_POST['nombre'],$_POST['apellido'], $_POST['email'], $contraseña, $_POST['nacimiento'], $_POST['icono']);";

        }

    }

?>

<section class="register">

<h2>Registrate y sé un piloto</h2>

<form method="POST">
    <div>
        <img src="img/registerPerfil.png" alt="Imagen de perfil" id="perfilImg"/>

        <div class="divPerfilImage" style="display:none;">
        <input type="radio" name="icono" value="null" checked/>
            <?php
                for($i = 0; $i < count($img); $i++) {
                    echo '<input type="radio" name="icono" value="'. $img[$i]['id'] .'" id="'. $img[$i]['nombre'] .'"/>';

                    echo '<label for="'. $img[$i]['nombre'] .'" class="perfilRadio">';
                    echo '<img src="img/marcas/'. $img[$i]['imagen'] .'" alt="'. $img[$i]['nombre'] .'"/>';
                    echo '</label>';
                }
            ?>
        </div>
    </div>

    <div>
        <p>Seleccioná tu piloto favorito</p>
                
        <select name="piloto">
            <option value="null">Elegí un piloto</option>
            <?php
            
                for($i = 0; $i < count($pilotos); $i++){
                    echo '<option value="'. $pilotos[$i]['id'] .'">';
                        echo '<p>'. $pilotos[$i]['nombre'] .'</p>';
                    echo '</option>';
                }
                
            ?>
        </select>
    </div>

    <div>
        <p>Nombre de usuario</p>
        <input type="text" name="usuario" maxlength="20"/>
        <p>Nombre</p>
        <input type="text" name="nombre" maxlength="30"/>
        <p>Apellido</p>
        <input type="text" name="apellido" maxlength="30"/>
        <p>Correo electronico</p>
        <input type="email" name="email"/>
        <p>Contraseña</p>
        <input type="password" maxlength="10" name="contraseña"/>
        <p>Confirmar contraseña</p>
        <input type="password" maxlength="10" name="confirmarContraseña"/>
        <p>Fecha de nacimiento</p>
        <input type="date" name="fecha"/>
        <input type="submit" value="Registrarse"/>
    </div>
</form>

</section>