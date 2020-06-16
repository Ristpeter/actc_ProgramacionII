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

?>

<section class="perfil">

    <form action="acciones/perfil.php" method="POST">
        <div>

            <?php
            
            if($_SESSION['usuario']['icono'] == 0){
                echo '<img id="perfilImg" src="img/registerPerfil.png" alt="Foto de perfil" />';
            }else{
                echo '<img id="perfilImg" src="img/marcas/'. $_SESSION['datos']['marcaImagen'] .'" alt="'. $_SESSION['datos']['marcaNombre'] .'" />';

            }

            ?>
            

            <div class="divPerfilImage" style="display:none;">
            <input type="radio" name="icono" value="<?php echo $_SESSION['datos']['marcasID']; ?>" checked/>
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
        <input type="submit" value="Editar"/>
    </form>

    <form action="acciones/perfil.php" method="POST">
        <div>
            <p>Piloto favorito</p>
            <select name="piloto">
                <option value="null">-</option>
                <?php
                    for($i = 0; $i < count($pilotos); $i++){

                        if($pilotos[$i]['id']==$_SESSION['usuario']['piloto_id']){
                            echo '<option selected="true" value="'. $pilotos[$i]['id'] .'">';
                                echo '<p>'. $pilotos[$i]['nombre'] .'</p>';
                            echo '</option>';
                        }else{
                            echo '<option value="'. $pilotos[$i]['id'] .'">';
                                echo '<p>'. $pilotos[$i]['nombre'] .'</p>';
                            echo '</option>';
                        }
                    }             
                ?>
            </select>
            <input type="submit" value="Editar"/>
        </div>
        </form>
        <form action="acciones/perfil.php" method="POST">
            <p>Nombre de usuario</p>
            <input type="text" value="<?php echo $_SESSION['usuario']['usuario'] ?>" name="usuario"/>
            <input type="submit" value="Editar"/>
        </form>
        <form action="acciones/perfil.php" method="POST">
            <p>Nombre</p>
            <input type="text" value="<?php echo $_SESSION['usuario']['nombre'] ?>" name="nombre"/>
            <input type="submit" value="Editar"/>
        </form>
        <form action="acciones/perfil.php" method="POST">
            <p>Apellido</p>
            <input type="text" value="<?php echo $_SESSION['usuario']['apellido'] ?>" name="apellido"/>
            <input type="submit" value="Editar"/>
        </form>
        <form action="acciones/perfil.php" method="POST">
            <p>Correo electronico</p>
            <input type="email" value="<?php echo $_SESSION['usuario']['email'] ?>" name="email"/>
            <input type="submit" value="Editar"/>
        </form>

        <form action="acciones/perfil.php" method="POST">
            <p>Contraseña</p>
            <input type="password" name="contraseña"/>
            <p>Confirmar contraseña</p>
            <input type="password" name="confirmarContraseña"/>
            <input type="submit" value="Editar"/>
        </form>
        <form action="acciones/perfil.php" method="POST">
            <p>Fecha de nacimiento</p>
            <input type="date" value="<?php echo $_SESSION['usuario']['nacimiento'] ?>" name="nacimiento" min="01-01-1900" max="01-01-2020"/>
            <input type="submit" value="Editar"/>
        </form>

        <?php

            if($_SESSION['usuario']['isAdmin'] == 1){
                echo '<a href="acciones/panelLogin.php">Panel</a>';
            }


        ?>

        <a href="acciones/logout.php">Cerrar sesión</a>
    </div>

</section>