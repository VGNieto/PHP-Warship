<?php


class dbJugador
{
    
public function __construct(){

}


public function añadirJugador($jugador){


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $ultimoIDQuery = mysqli_query($conexion,"select max(IDJugador) from Jugadores");
    $ultimoID = (mysqli_fetch_array($ultimoIDQuery)[0][0])+1;

   
    $insertar = "insert into jugadores(IDJugador,Usuario,Password) values($ultimoID,'$jugador->usuario','$jugador->contraseña')";
    echo($insertar);
    mysqli_query($conexion,$insertar) or die("Problemas al añadir un jugador: " .mysqli_error($conexion));

    
    mysqli_close($conexion);

}




}
