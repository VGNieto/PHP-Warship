<?php

require_once("./controladores/classPartidas.php");
class dbPartidas
{
    
public function __construct(){

}


public function crearPartidaDB($host,$nombre,$contraseña){

    if($this->comprobarExistente($nombre) == false){

        $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    
        $insertar = "insert into partidas(IDHost,IDEstadoPartida,passwordPartida,nombrePartida) values('$host',8,'$contraseña','$nombre')";
    
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
    if($estado == 8 &&  $host!=$idContrincante){
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
         mysqli_close($conexion);
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
        mysqli_close($conexion);
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
            
            }
            mysqli_close($conexion);
            return true;
        

    }





}

public function devolverTablerosDB($idPartida){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");
    $tableros;
    $consultaTableros = "select IDTablero,IDJugador from tableros where IDPartida = $idPartida";
    unset($queryTableros);
    unset($tableros);
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die("Problemas al devolver los tableros:".mysqli_error($conexion));
    
    if(mysqli_num_rows($queryTableros)==0){
        return false;
    }
    while($results = mysqli_fetch_array($queryTableros)){
        $tableros[] = $results[0];
        $jugadores[] = $results[1];
    }
    
    if(count($tableros)!=0){
        $tableroHostArray;
        $tableroHost = "select * from casillas where IDTablero = $tableros[0]";
        $queryTableroHost = mysqli_query($conexion,$tableroHost);
        
        if(mysqli_num_rows($queryTableroHost)>0){
            while($results = mysqli_fetch_array($queryTableroHost)){
                $tableroHostArray[] = [$results[0],$results[1],$results[2],$results[3],$results[4]];
            }
        } else{
            $tableroHostArray = false;
        }

        $tableroContrincanteArray;
        $tableroContrincante = "select * from casillas where IDTablero = $tableros[1]";
        $queryTableroContrincante = mysqli_query($conexion,$tableroContrincante) or die(mysqli_error($conexion));

        if(mysqli_num_rows($queryTableroContrincante)>0){
            while($results = mysqli_fetch_array($queryTableroContrincante)){
                $tableroContrincanteArray[] = [$results[0],$results[1],$results[2],$results[3],$results[4]];
            }
        } else{
            $tableroContrincanteArray = false;
        }
        
    }
    mysqli_close($conexion);
    return [$tableroHostArray,$tableroContrincanteArray];

}

public function devolverEstadoPartida($idPartida){


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaEstado = "select IDEstadoPartida from partidas where IDPartida=$idPartida";
    $queryEstado = mysqli_query($conexion,$consultaEstado) or die("PRoblemas con el estado: ".mysqli_error($conexion));
    $estado = mysqli_fetch_array($queryEstado)[0];
    
    mysqli_close($conexion);
    return $estado;
}

public function devolverHostPartida($idPartida){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaHost = "select IDHost from partidas where idPartida = $idPartida";
    $queryHost = mysqli_query($conexion,$consultaHost) or die ("No se encuentra el host:".mysqli_error($conexion));

    if(mysqli_num_rows($queryHost)>0){
        $host = mysqli_fetch_array($queryHost)[0];
        mysqli_close($conexion);
        return $host;
    } else{
        mysqli_close($conexion);
        return false;
    }

}

public function introducirBarco($longitud,$direccion,$letra,$numero,$idUsuario,$idPartida,$tipoBarco){

    $filas = [1,2,3,4,5,6,7,8,9,10];
    $columnas = [1,2,3,4,5,6,7,8,9,10];

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTablero = "select idTablero from tableros where IDJugador=$idUsuario and idPartida = $idPartida";
    $tablero = mysqli_fetch_array(mysqli_query($conexion,$consultaTablero))[0];
    
    switch($direccion){
        case "vertical":    
        
                        if($this->comprobarEspacio($longitud,$direccion,$letra,$numero,$idUsuario,$idPartida,$tipoBarco)){
                            $bloquear = $this->bloquearAdyacentes($longitud,$direccion,$letra,$numero,$idUsuario,$idPartida,$tipoBarco);

                            $insertarBloqueos = "insert into casillas (Letra,Numero,IDTablero,IDTipoBarco) values";
                            for($i = 0; $i<count($bloquear);$i++){
                                $fila = $bloquear[$i][0];
                                $columna = $bloquear[$i][1];
                                $insertarBloqueos .= "($fila,$columna,$tablero,'bloqueado'),";
                            }
                            $insertarBloqueos = substr($insertarBloqueos,0,strlen($insertarBloqueos)-1);
                            mysqli_query($conexion,$insertarBloqueos) or die("problemas amigo;".mysqli_error($conexion));
        
        
                            $posicion = array_search($letra,$filas);
                            $insertarBarcos = "insert into casillas (Letra,Numero,IDTablero,IDTipoBarco) values";
                            for($i = $posicion; $i<$posicion+$longitud;$i++){
                                if($i>9){
                                    return false;
                                }
                                $insertarBarcos .= "($filas[$i],$numero,$tablero,'$tipoBarco'),";
                            }
                            $insertarBarcos = substr($insertarBarcos,0,strlen($insertarBarcos)-1);
                            mysqli_query($conexion,$insertarBarcos) or die("problemas amigo;".mysqli_error($conexion));
                        } else{
                            return false;
                        }
                            break;
        case "horizontal":  
                            if($this->comprobarEspacio($longitud,$direccion,$letra,$numero,$idUsuario,$idPartida,$tipoBarco)){

                                $bloquear = $this->bloquearAdyacentes($longitud,$direccion,$letra,$numero,$idUsuario,$idPartida,$tipoBarco);

                                $insertarBloqueos = "insert into casillas (Letra,Numero,IDTablero,IDTipoBarco) values";
                                for($i = 0; $i<count($bloquear);$i++){
                                    $fila = $bloquear[$i][0];
                                    $columna = $bloquear[$i][1];
                                    $insertarBloqueos .= "($fila,$columna,$tablero,'bloqueado'),";
                                }
                                $insertarBloqueos = substr($insertarBloqueos,0,strlen($insertarBloqueos)-1);
                                mysqli_query($conexion,$insertarBloqueos) or die("problemas amigo;".mysqli_error($conexion));
            
                                $posicion = array_search($numero,$filas);
                                $insertarBarcos = "insert into casillas (Letra,Numero,IDTablero,IDTipoBarco) values";
                                for($i = $posicion; $i<$posicion+$longitud;$i++){
                                    if($i>9){
                                        mysqli_close($conexion);

                                        return false;
                                    }
                                    $insertarBarcos .= "($letra,$filas[$i],$tablero,'$tipoBarco'),";
                                }
                                $insertarBarcos = substr($insertarBarcos,0,strlen($insertarBarcos)-1);
                                mysqli_query($conexion,$insertarBarcos) or die("problemas amigo;".mysqli_error($conexion));

                            
                            } else{
                                mysqli_close($conexion);

                                return false;
                            }
                            break;


    }
    mysqli_close($conexion);
    return true;

}

public function ultimoBarcoInsertado($idPartida,$idUsuario){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTablero = "select idTablero from tableros where IDJugador=$idUsuario and idPartida = $idPartida";
    $tablero = mysqli_fetch_array(mysqli_query($conexion,$consultaTablero))[0];

    $consultaUltimoBarco = "select IDtipoBarco from casillas  where IDTablero = $tablero order by IDCasilla desc limit 1";
    $queryUltimoBarco = mysqli_query($conexion,$consultaUltimoBarco) or die("Problemas con el ultimo barco:".mysqli_error($conexion));
    
    if(mysqli_num_rows($queryUltimoBarco)>0){
        $ultimoBarco = mysqli_fetch_array($queryUltimoBarco)[0];
        mysqli_close($conexion);
        return $ultimoBarco;
    } else{
        mysqli_close($conexion);
        return false;
    }


}

public function comprobarCasilla($letra,$numero,$idUsuario,$idPartida){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTablero = "select idTablero from tableros where IDJugador=$idUsuario and idPartida = $idPartida";
    $tablero = mysqli_fetch_array(mysqli_query($conexion,$consultaTablero))[0];

    $consultaCasilla = "select * from casillas  where IDTablero = $tablero and letra=$letra and numero=$numero";
    $queryCasilla = mysqli_query($conexion,$consultaCasilla) or die("Problemas con esa casilla:".mysqli_error($conexion));

    if(mysqli_num_rows($queryCasilla)>0){
        mysqli_close($conexion);
        return false;
    } else{
        mysqli_close($conexion);
        return true;
    }

}

public function cambiarEstadoPartida($idPartida,$nuevoEstado){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $modificarEstado = "update partidas set IDEstadoPartida = $nuevoEstado where IDPartida = $idPartida";
    if(mysqli_query($conexion,$modificarEstado) or die("Problemas al actualizar el estado: ".mysqli_error($conexion))){
        mysqli_close($conexion);
        return true;
    }else{
        mysqli_close($conexion);
        return false;
    }
    
}

public function atacarCasilla($letra,$numero,$idUsuario,$idPartida){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    
    $consultaTablero = "select idTablero from tableros where IDJugador!=$idUsuario and idPartida = $idPartida";
    $tablero = mysqli_fetch_array(mysqli_query($conexion,$consultaTablero))[0];

    $updateFila = "update casillas set idtipoBarco='barcoTocado' where letra=$letra and numero = $numero and idTablero = $tablero";
    $updateBloqueado = "update casillas set idtipoBarco='aguaTocada' where letra=$letra and numero = $numero and idTablero = $tablero";

    $comprobarPosicion = "select idtipobarco from casillas where letra=$letra and numero=$numero and idTablero = $tablero";

    if($resultado = mysqli_fetch_array(mysqli_query($conexion,$comprobarPosicion))[0]){

        if($resultado!= 'bloqueado'){
            if(mysqli_query($conexion,$updateFila) or die("Problemas con la modificacion de casilla.".mysqli_error($conexion))){
                mysqli_close($conexion);
                return true;
            } 
        } else{
            if(mysqli_query($conexion,$updateBloqueado) or die("Problemas con la insercion de agua.".mysqli_error($conexion))){
                mysqli_close($conexion);
                return false;
            }
        }
        
    
    } else{
        $insertarAgua = "insert into casillas(Letra,Numero,IDTablero,idTipoBarco) values($letra,$numero,$tablero,'aguaTocada')";
        if(mysqli_query($conexion,$insertarAgua) or die("Problemas con la insercion de agua.".mysqli_error($conexion))){
            mysqli_close($conexion);
            return false;
        } 
       
    }

    

    
}

public function comprobarGanador($idPartida){
    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTableros = "select idTablero from tableros where idPartida = $idPartida";
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die ("Problemas al encontrar los tableros:".mysqli_error($conexion));
    

    if(mysqli_num_rows($queryTableros)>0){
       while($results = mysqli_fetch_array($queryTableros)){
           $tableros[] = $results[0];
       }


        for($i=0;$i<2;$i++){
            $queryGanador = "select count(idTipoBarco) from casillas where idTablero=$tableros[$i] and idTipoBarco='barcoTocado'";
            $ganador = mysqli_query($conexion,$queryGanador) or die("Problemas con el ganador;".mysqli_error($conexion));
            if(mysqli_num_rows($ganador)>0){
                $hundidos = mysqli_fetch_array($ganador)[0];

                if($hundidos == 21){
                    mysqli_close($conexion);

                    return $tableros[$i];
                }
            }

        }
    } 
    mysqli_close($conexion);

    return false;

}

public function comprobarBarcosHundidos($idPartida,$idUsuario){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTableros = "select idTablero from tableros where idPartida = $idPartida and idJugador != $idUsuario";
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die ("Problemas al encontrar los tableros:".mysqli_error($conexion));
    
    $devolverBarcos = "Barcos hundidos:-";
    if(mysqli_num_rows($queryTableros)>0){
       $tablero = mysqli_fetch_array($queryTableros)[0];
       $barcos = ['Portaviones','Acorazado','Crucero1','Crucero2','Destructor1','Destructor2','Destructor3'];

       for($i = 0; $i<count($barcos);$i++){

        $consultaBarcos = "Select count(idTipoBarco) from casillas where idTipoBarco='$barcos[$i]' and idTablero=$tablero";
        $query = mysqli_query($conexion,$consultaBarcos) or die("Problemas con los barcos hundidos;".mysqli_error($conexion));
        if(mysqli_fetch_array($query)[0] == 0){
            $devolverBarcos.=$barcos[$i]."-";
        }
       }


        
    } 
    mysqli_close($conexion);

    return $devolverBarcos;


}

public function bloquearAdyacentes($longitud,$direccion,$fila,$columna,$idUsuario,$idPartida,$tipoBarco){

    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTableros = "select idTablero from tableros where idPartida = $idPartida and idJugador = $idUsuario";
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die ("Problemas al encontrar los tableros:".mysqli_error($conexion));
    
  
    if(mysqli_num_rows($queryTableros)>0){
       $tablero = mysqli_fetch_array($queryTableros)[0];
       unset($posicionesBloqueadas);
       $posicionesBloqueadas;
       switch($direccion){
           case "horizontal":   //Fila arriba
                                if($fila>1){
                                    for($i = $columna-1;$i<($longitud+$columna+1);$i++){
                                        $posicionesBloqueadas[] = [$fila-1,$i];
                                    }
                                }
                                //Fila abajo
                                if($fila<10){
                                    for($i = $columna-1;$i<($longitud+$columna+1);$i++){
                                        $posicionesBloqueadas[] = [$fila+1,$i];
                                    }
                                }
                                //Fila izquierda
                                if($columna>1){
                                   
                                        $posicionesBloqueadas[] = [$fila,$columna-1];
                                    
                                }
                                //Fila derecha
                                if($columna<10){
                                    
                                        $posicionesBloqueadas[] = [$fila,$columna+$longitud];
                                    
                                }
                                break;
            case "vertical":   //Fila izquierda
                                if($columna>1){
                                    for($i = $fila-1;$i<($longitud+$fila+1);$i++){
                                        $posicionesBloqueadas[] = [$i,$columna-1];
                                    }
                                }
                                //Fila derecha
                                if($columna<10){
                                    for($i = $fila-1;$i<($longitud+$fila+1);$i++){
                                        $posicionesBloqueadas[] = [$i,$columna+1];
                                    }
                                }
                                //Fila arriba
                                if($fila>1){
                                   
                                        $posicionesBloqueadas[] = [$fila-1,$columna];
                                    
                                }
                                //Fila abajo
                                if($fila<10){
                                    
                                        $posicionesBloqueadas[] = [$fila+$longitud,$columna];
                                    
                                }
                                break;


                                
       }

    } 
    mysqli_close($conexion);

    return $posicionesBloqueadas;

}


public function comprobarEspacio($longitud,$direccion,$fila,$columna,$idUsuario,$idPartida,$tipoBarco){


    $conexion = mysqli_connect("localhost","root","","hundirlaflota");

    $consultaTableros = "select idTablero from tableros where idPartida = $idPartida and idJugador = $idUsuario";
    $queryTableros = mysqli_query($conexion,$consultaTableros) or die ("Problemas al encontrar los tableros:".mysqli_error($conexion));
    
  
    if(mysqli_num_rows($queryTableros)>0){
       $tablero = mysqli_fetch_array($queryTableros)[0];

       switch($direccion){
        case "horizontal": 
                            if(($longitud+$columna-1)<=10){
                                for($i = $columna;$i<$longitud+$columna;$i++){

                            
                                    $consulta = "select idtipobarco from casillas where letra = $fila and numero=$i and idTablero = $tablero ";
                                   
                                    $query = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                                    echo mysqli_fetch_array($query)[0];
                                    echo mysqli_num_rows($query);
                                        if(mysqli_num_rows($query)>0){
                                            mysqli_close($conexion);

                                            return false;
                                            
                                        } 
                                
        
                                    }                
                            } else{
                                mysqli_close($conexion);

                                return false;
                            }
                            
                            
                             break;

         case "vertical":   if(($longitud+$fila-1)<=10){
         
                                for($i = $fila;$i<$longitud+$fila;$i++){

                                
                                $consulta = "select idtipobarco from casillas where letra = $i and numero=$columna and idTablero = $tablero ";
                                $query = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                                    if(mysqli_num_rows($query)>0){
                                        mysqli_close($conexion);

                                        return false;
                                        
                                    } 
                            

                                }
                            } else{
                                mysqli_close($conexion);

                                return false;
                            }
                             break;


            
        }
        mysqli_close($conexion);

    return true;
    }



}


}
?>