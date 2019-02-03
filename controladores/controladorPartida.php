<?php
require_once("./modelos/dbPartidas.php");

class Partida extends dbPartidas
{
    
public function __construct(){
   
}

public function mostrarPartida($idPartida){
    $tableros = $this->mostrarTableros($idPartida);
    include "./vistas/mostrarPartida.php";

}

public function mostrarTableros($idPartida){


    $tableros = $this->devolverTablerosDB($idPartida);
    return $tableros;
}

public function crearTableros($idPartida){
    if($this->crearTablerosDB($idPartida)){
        $this->mostrarPartida($idPartida);
    } else{
        $this->mostrarPartida($idPartida);
    };
}







}