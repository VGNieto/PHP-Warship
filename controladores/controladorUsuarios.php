<?php
require_once("./modelos/dbUsuarios.php");

class Usuarios extends dbUsuarios
{
    
public function __construct(){
   
}


public function mostrarLogin(){

    include "./vistas/login.php";

}

public function mostrarError(){
    echo "no amigo";
}
function añadirUsuario($usuario,$contraseña){
    $this->añadirJugadorDB($usuario,$contraseña);
}

function devolverUsuarios(){
    return $this->devolverUsuariosDB();
}

function comprobarUsuario($usuario,$contraseña){
    
    return  $this->comprobarUsuarioDB($usuario,$contraseña);
}

}
