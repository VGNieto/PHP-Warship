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
    
     if( $this->mostrarPartidasDB()){
         $partidas = $this->mostrarPartidasDB();
         return $partidas;
     } else{
         return false;
     }
}
public function listaPartidasEnCurso($id){
    if( $this->partidasEnCursoDB($id)){
        $partidas = $this->partidasEnCursoDB($id);
        return $partidas;
    } else{
        return false;
    }
}

public function unirseAPartida($idPartida,$idContrincante){
    return $this->unirseAPartidaDB($idPartida,$idContrincante);
}

public function cambiarEstado($idPartida,$nuevoEstado){
    return $this->cambiarEstadoPartida($idPartida,$nuevoEstado);
}

public function crearPartida($host,$nombre,$contraseña){
    return $this->crearPartidaDB($host,$nombre,$contraseña);
}


    
}
