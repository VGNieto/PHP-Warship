<?php

require_once("./controladores/classPartidas.php");
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

public function mostrarPartidasDB(){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select distinct IDPartida,jugadores.Usuario,estadospartida.Descripcion,nombrePartida,passwordPartida from partidas
                        ,Jugadores,estadosPartida where jugadores.IDJugador = partidas.IDHost and
                        estadosPartida.IDEstadoPartida = partidas.IDEstadoPartida;";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $contrincante = "";
        

        $insertarOtra = "select distinct jugadores.Usuario from partidas
                        ,Jugadores where jugadores.IDJugador = partidas.IDContrincante
                        and partidas.IDPartida = $results[0];";
        $resultadoOtro = mysqli_query($conexion,$insertarOtra) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
        while ($resultsOtro = mysqli_fetch_array($resultadoOtro)) {
            if(mysqli_num_rows($resultadoOtro) < 1){
                $contrincante = "";
            } else{
                $contrincante = $resultsOtro[0];
            }
        }
        $partida = new Partidas($results[0],$results[1],$contrincante,$results[2],$results[3],$results[4]);
        $datos[] = $partida;
        

     }
     mysqli_close($conexion);
     if(count($datos) == 0){
         return false;
     } else{
         return $datos;
     }
}

public function unirseAPartidaDB($idPartida,$idContrincante){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select IDPartida,IDHost,IDEstadoPartida from partidas where IdPartida=$idPartida";
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $estado = $results[2];
        $host = $results[1];
     }
    if($estado == 1 &&  $host!=$idContrincante || $estado == 2 && $host!=$idContrincante){
        $queryUnirse = "update partidas set IDContrincante = $idContrincante where IDPartida = $idPartida";
        mysqli_query($conexion,$queryUnirse) or die("Problemas al modificar una partida: " .mysqli_error($conexion));
        mysqli_close($conexion);
        return true;
    } else{
        return false;
    }
     
}

public function borrarPartidaDB($id){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select * from partidas where IdPartida=$id";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $datos[] = $results[0];
     }
     
     if(count($datos) == 0){
         return false;
     } else{
        mysqli_query($conexion,"delete from partidas where IDPartida = $id")or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
        return true;
    }
  
}

public function partidasEnCursoDB($id){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select distinct IDPartida,jugadores.Usuario,estadospartida.Descripcion,nombrePartida,passwordPartida from partidas
                        ,Jugadores,estadosPartida where jugadores.IDJugador = partidas.IDHost and
                        estadosPartida.IDEstadoPartida = partidas.IDEstadoPartida and partidas.IDHost = $id
                        or partidas.IDContrincante = $id and jugadores.IDJugador = partidas.IDHost and
                        estadosPartida.IDEstadoPartida = partidas.IDEstadoPartida";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $contrincante = "";
        

        $insertarOtra = "select distinct jugadores.Usuario from partidas
                        ,Jugadores where jugadores.IDJugador = partidas.IDContrincante
                        and partidas.IDPartida = $results[0];";
        $resultadoOtro = mysqli_query($conexion,$insertarOtra) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
        while ($resultsOtro = mysqli_fetch_array($resultadoOtro)) {
            if(mysqli_num_rows($resultadoOtro) < 1){
                $contrincante = "";
            } else{
                $contrincante = $resultsOtro[0];
            }
        }
        $partida = new Partidas($results[0],$results[1],$contrincante,$results[2],$results[3],$results[4]);
        $datos[] = $partida;
        

     }
     mysqli_close($conexion);
     if(count($datos) == 0){
         return false;
     } else{
         return $datos;
     }
}




}


?>