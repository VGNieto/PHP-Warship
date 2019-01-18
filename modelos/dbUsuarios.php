<?php


class dbUsuarios
{
    
public function __construct(){

}


public function añadirJugadorDB($usuario,$contraseña){


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $ultimoIDQuery = mysqli_query($conexion,"select max(IDJugador) from Jugadores");
    $ultimoID = (mysqli_fetch_array($ultimoIDQuery)[0][0])+1;

   
    $insertar = "insert into jugadores(IDJugador,Usuario,Password) values($ultimoID,'$usuario','$contraseña')";

    mysqli_query($conexion,$insertar) or die("Problemas al añadir un jugador: " .mysqli_error($conexion));

    
    mysqli_close($conexion);

}

public function devolverUsuariosDB(){


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select * from jugadores";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $datos[] = $results[1];
     }
    mysqli_close($conexion);
    return $datos;

}

public function comprobarUsuarioDB($usuario,$contraseña){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select * from jugadores where Usuario='$usuario' and Password='$contraseña'";
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
