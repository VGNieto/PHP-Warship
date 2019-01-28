<?php
require_once("./modelos/dbPartidas.php");

class Partida extends dbPartidas
{
    
public function __construct(){
   
}

public function mostrarPartida($id){

    include "./vistas/mostrarPartida.php";

}







}