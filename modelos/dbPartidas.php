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

public function borrarPartidaDB($idPartida){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $insertar = "select * from partidas where IdPartida=$idPartida";
    $datos = array();
    $resultado = mysqli_query($conexion,$insertar) or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
    while ($results = mysqli_fetch_array($resultado)) {
        $datos[] = $results[0];
     }
     
     if(count($datos) == 0){
         return false;
     } else{
        
        $consultaTableros = "select IDTablero from tableros where IDPartida = $idPartida";
        $queryTableros = mysqli_query($conexion,$consultaTableros) or die("Problemas al devolver los tableros:".mysqli_error($conexion));
        while($results = mysqli_fetch_array($queryTableros)){
            $tableros[] = $results[0];
        }        

        mysqli_query($conexion,"delete from casillas where IdTablero = $tableros[0]");
        mysqli_query($conexion,"delete from casillas where IdTablero = $tableros[1]");
        mysqli_query($conexion,"delete from partidas where IDPartida = $idPartida")or die("Problemas al devolver un jugador: " .mysqli_error($conexion));
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


public function crearTablerosDB($idPartida){

    $letras = ["A","B","C","D","E","F","G","H","I","J"];
    $numeros = [1,2,3,4,5,6,7,8,9,10];

    $consultaIDs = "select IDHost,IDContrincante from partidas where idPartida = $idPartida";


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $queryIDs = mysqli_query($conexion,$consultaIDs);
    $datos = mysqli_fetch_array($queryIDs);

    if($datos[0] != null && $datos[1] != null){

        
        $comprobarExistente = "select * from tableros where IDPArtida=$idPartida";
        if(mysqli_num_rows(mysqli_query($conexion,$comprobarExistente))>0){
            mysqli_close($conexion);
            return false;
        } else{

            $ultimoTablero = "select max(IDTablero) from tableros";
            $ultimoValor = mysqli_fetch_array(mysqli_query($conexion,$ultimoTablero));        

            $crearTableros = "insert into tableros values($ultimoValor[0]+1,$datos[0],$idPartida),($ultimoValor[0]+2,$datos[1],$idPartida)";
            mysqli_query($conexion,$crearTableros) or die("Problemas al crear los tableros: ". mysqli_error($conexion));
            
            $consultaTableros = "select IDTablero from tableros where IDPartida = $idPartida";
            $queryTableros = mysqli_query($conexion,$consultaTableros);
            while($results = mysqli_fetch_array($queryTableros)){
                $tableros[] = $results[0];
            }
       
            $añadirCasilla = "insert into casillas(Letra,Numero,IDTablero,IDEstadoCasilla) values";
            for($i = 0; $i<10;$i++){
                for($j = 0;$j<10;$j++){
                    $añadirCasilla .= "('$letras[$i]',$numeros[$j],$tableros[0],1),";
                   
                }
            }
            $añadirCasilla =  substr($añadirCasilla,0,strlen($añadirCasilla)-1);
            mysqli_query($conexion,$añadirCasilla) or die("Problemas amigo".mysqli_error($conexion));
            
            $añadirCasilla = "insert into casillas(Letra,Numero,IDTablero,IDEstadoCasilla) values";
            for($i = 0; $i<10;$i++){
                for($j = 0;$j<10;$j++){
                    $añadirCasilla .= "('$letras[$i]',$numeros[$j],$tableros[1],1),";
                   
                }
            }
            $añadirCasilla =  substr($añadirCasilla,0,strlen($añadirCasilla)-1);
             mysqli_query($conexion,$añadirCasilla) or die("Problemas amigo".mysqli_error($conexion));


            }
            mysqli_close($conexion);
            return true;
        

    }





}

public function devolverTablerosDB($idPartida){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $tableros;
    $consultaTableros = "select IDTablero from tableros where IDPartida = $idPartida";
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die("Problemas al devolver los tableros:".mysqli_error($conexion));
    while($results = mysqli_fetch_array($queryTableros)){
        $tableros[] = $results[0];
        
    }
    
    if(count($tableros)!=0){
        $tableroHostArray;
        $tableroHost = "select * from casillas where IDTablero = $tableros[0]";
        $queryTableroHost = mysqli_query($conexion,$tableroHost);
        while($results = mysqli_fetch_array($queryTableroHost)){
            $tableroHostArray[] = [$results[0],$results[1],$results[2],$results[3],$results[4]];
        }

        $tableroContrincanteArray;
        $tableroContrincante = "select * from casillas where IDTablero = $tableros[0]";
        $queryTableroContrincante = mysqli_query($conexion,$tableroContrincante);
        while($results = mysqli_fetch_array($queryTableroContrincante)){
            $tableroContrincanteArray[] = [$results[0],$results[1],$results[2],$results[3],$results[4]];
        }

        $tablerosDevolver[0] = $tableroHostArray;
        $tablerosDevolver[1] = $tableroContrincanteArray;

        return  $tablerosDevolver;
    }







}


}


?>