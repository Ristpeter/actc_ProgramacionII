<?php

    if($_GET['edit'] == 'noticias'){
        require_once('noticiasCrear.php');
    }else if($_GET['edit'] == 'pilotos'){
        require_once('pilotosCrear.php');
    }else if($_GET['edit'] == 'marcas'){
        require_once('marcasCrear.php');
    }

?>