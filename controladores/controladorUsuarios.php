<?php
require_once("./modelos/dbUsuarios.php");

class Usuarios extends dbUsuarios
{
    
public function __construct(){
   
}


public function mostrarLogin(){

    include "./vistas/login.php";

}

public function mostrarRegistro($value){
    $registrado = false;
    if($value == true){
        $registrado = true;
    }
    include "./vistas/registrarUsuario.php";

}

function añadirUsuario($usuario,$contraseña){
    return $this->añadirJugadorDB($usuario,$contraseña);
}

function idUsuario($nombre){
    return $this->comprobarIDUsuarioDB($nombre);
}

function devolverUsuarios(){
    return $this->devolverUsuariosDB();
}

function comprobarUsuario($usuario,$contraseña){
    
    return  $this->comprobarUsuarioDB($usuario,$contraseña);
}

}
