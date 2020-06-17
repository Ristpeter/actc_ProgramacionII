<?php

$panelMenu = [
    'Cuentas' => '&edit=usuarios',
    'Noticias' => '&edit=noticias',
    'Pilotos' => '&edit=pilotos',
    'Marcas' => '&edit=marcas',
    'Votaciones' => '&edit=votaciones',
];

?>

<section>

<?php

    foreach ($panelMenu as $key => $value) {
        echo '<a href="?seccion=panelcrud'. $value .'">'. $key .'</a>';
    }

    
?>


</section>


<!--

NOTICIAS QUITAR MODIFICAR AGREGAR


PILOTOS QUITAR MODIFICAR AGREGAR


MARCAS QUITAR MODIFICAR AGREGAR


VOTACIONES QUITAR MODIFICAR AGREGAR


USUARIOS QUITAR MODIFICAR AGREGAR
-->