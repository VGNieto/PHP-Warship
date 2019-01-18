<?php

require_once("./controladores/controladorUsuarios.php");
require_once("./controladores/controladorMenu.php");
require_once("./controladores/controladorPartida.php");

class ControladorPrincipal 
{
    
public function __construct(){
   
}


public function controlarOpcion(){
    session_start();
    $usuarios = new Usuarios();
    $menuPrincipal = new Menu();
    //$partida = new Partida();

    $opcion = isset($_POST['op']);
    
    if($opcion == 'login'){ 
        if(isset($_POST['loginDone'])){
            $usuario = $_POST['loginUsuario'];
            $contraseña = $_POST['loginContraseña'];
            if($usuarios->comprobarUsuario($usuario,$contraseña) != false){
                $menuPrincipal->mostrarMenu();
            }
        } else{
            $usuarios->mostrarLogin();
        }
        
    } else if($opcion == 'registro'){
        $usuarios->mostrarRegistro();
    } else if($opcion == null){
        $usuarios->mostrarLogin();
    } else if($opcion == 'menuPrincipal'){
        $menuPrincipal -> mostrarMenu();
    } else if($opcion == 'Salir'){
        $usuarios->mostrarLogin();
    }
}
    
}
