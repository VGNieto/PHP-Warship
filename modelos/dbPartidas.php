<?php


class dbPartidas
{
    
public function __construct(){

}


public function crearPartidaDB($host,$nombre,$contraseña){

    if($this->comprobarExistente($nombre) == false){

        $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    
        $insertar = "insert into partidas(IDHost,IDEstadoPartida,passwordPartida,nombrePartida) values('$host',1,'$contraseña','$nombre')";
    
        mysqli_query($conexion,$insertar) or die("Problemas al añadir una partida: " .mysqli_error($conexion));
    
        
        mysqli_close($conexion);
        return true;
        } else{
            return false;
        }
}




public function comprobarExistente($nombre){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select * from partidas where nombrePartida='$nombre'";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $datos[] = $results[0];
     }
     mysqli_close($conexion);
     if(count($datos) == 0){
         return false;
     } else{
         return $datos[0];
     }
  
}




}


?>