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

public function mostrarPartidas($id){
    include "./vistas/listaPartidas.php";
}

public function mostrarPartidasEnCurso($id){
    include "./vistas/mostrarPartidasEnCurso.php";
}

public function borrarPartida($id){
    return $this->borrarPartidaDB($id);
}

public function listaPartidas(){
    return $this->mostrarPartidasDB();
}
public function listaPartidasEnCurso($id){
    return $this->partidasEnCursoDB($id);
}



public function unirseAPartida($idPartida,$idContrincante){
    return $this->unirseAPartidaDB($idPartida,$idContrincante);
}

public function crearPartida($host,$nombre,$contraseña){
    return $this->crearPartidaDB($host,$nombre,$contraseña);
}


    
}
