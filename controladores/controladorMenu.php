<?php
require_once("./modelos/dbPartidas.php");

class Menu extends dbPartidas
{
    
public function __construct(){
   
}

public function mostrarMenu(){
    include "./vistas/menuPrincipal.php";
}

public function mostrarNuevaPartida(){
    include "./vistas/nuevaPartida.php";
}

public function mostrarPartidas(){
    include "./vistas/listaPartidas.php";
}

public function listaPartidas(){
    return $this->mostrarPartidasDB();
}

public function unirseAPartida($idPartida,$idContrincante){
    return $this->unirseAPartidaDB($idPartida,$idContrincante);
}

public function crearPartida($host,$nombre,$contraseña){
    return $this->crearPartidaDB($host,$nombre,$contraseña);
}


    
}
