<?php

    require_once './controladores/controladorPrincipal.php';

    session_start();
    $controlador = new ControladorPrincipal();

    $controlador->controlarOpcion();


?>
