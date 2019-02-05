<?php
require_once("./modelos/dbPartidas.php");


class Partida extends dbPartidas
{
    
public function __construct(){
   
}

public function handlerCasilla($casilla,$idPartida){


    $letra = substr($casilla,0,1);
    $numero = substr($casilla,1,1);
    $idUsuario = substr($casilla,3,1);

    $estadoPartida = $this->devolverEstadoPartida($idPartida);

    switch($estadoPartida){
        case 1: switch($this->ultimoBarcoInsertado($idPartida,$_SESSION['idUsuario'])){
                    case "Portaviones": 
                                        if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(4,"vertical",$letra,$numero,$idUsuario,$idPartida,"Acorazado");
                                            $this->mostrarPartida($idPartida);
                                            
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                                       
                    case "Acorazado": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,"vertical",$letra,$numero,$idUsuario,$idPartida,"Crucero1");
                                        $this->mostrarPartida($idPartida);
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Crucero1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,"vertical",$letra,$numero,$idUsuario,$idPartida,"Crucero2");
                                        $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;
                    case "Crucero2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor1");
                                            $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;

                    case "Destructor1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                         $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor2");
                                         $this->mostrarPartida($idPartida);
                                        }
                                        else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                            break;
                    case "Destructor2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor3");
                                            $this->mostrarPartida($idPartida);
                                        }else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Destructor3": $this->cambiarEstadoPartida($idPartida,2);
                                        $this->mostrarPartida($idPartida);
                                        break;
                    case false: $this->introducirBarco(5,"vertical",$letra,$numero,$idUsuario,$idPartida,"Portaviones");
                                 $this->mostrarPartida($idPartida);

                                        break;
                }
        
                
                break;

        case 2: switch($this->ultimoBarcoInsertado($idPartida,$_SESSION['idUsuario'])){
                    case "Portaviones": 
                                        if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(4,"vertical",$letra,$numero,$idUsuario,$idPartida,"Acorazado");
                                            $this->mostrarPartida($idPartida);
                                            
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                                       
                    case "Acorazado": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,"vertical",$letra,$numero,$idUsuario,$idPartida,"Crucero1");
                                        $this->mostrarPartida($idPartida);
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Crucero1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,"vertical",$letra,$numero,$idUsuario,$idPartida,"Crucero2");
                                        $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;
                    case "Crucero2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor1");
                                            $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;

                    case "Destructor1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                         $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor2");
                                         $this->mostrarPartida($idPartida);
                                        }
                                        else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                            break;
                    case "Destructor2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,"vertical",$letra,$numero,$idUsuario,$idPartida,"Destructor3");
                                            $this->mostrarPartida($idPartida);
                                        }else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Destructor3": //$this->cambiarEstadoPartida($idPartida,3);
                                        $this->mostrarPartida($idPartida);
                                        break;
                    case false: $this->introducirBarco(5,"vertical",$letra,$numero,$idUsuario,$idPartida,"Portaviones");
                                 $this->mostrarPartida($idPartida);

                                        break;
                }

    }
}
public function mostrarPartida($idPartida){
    $tableros = $this->mostrarTableros($idPartida);
    $usuario = $_SESSION['idUsuario'];
    $estado = $this->devolverEstadoPartida($idPartida);
    $host = $this->devolverHostPartida($idPartida);
    $_SESSION['partida'] = $idPartida;
    switch($estado){
        case 1: $mensaje;
                 switch($this->ultimoBarcoInsertado($idPartida,$usuario)){
                        case "Portaviones": $mensaje = "Barcos a colocar: 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                        case "Acorazado":$mensaje = "Barcos a colocar: 2 Cruceros y 3 Destructores.";
                                            break;
                        case "Crucero1": $mensaje = "Barcos a colocar: 1 Crucero y 3 Destructores.";
                                            break;
                        case "Crucero2": $mensaje = "Barcos a colocar: 3 Destructores.";
                                            break;
                        case "Destructor1": $mensaje = "Barcos a colocar: 2 Destructores.";
                                            break;
                        case "Destructor2": $mensaje = "Barcos a colocar: 1 Destructor.";
                                            break;
                        case "Destructor3": $mensaje = "Espera hasta que el rival coloque los barcos.";
                                            break;
                        case false: $mensaje = "Barcos a colocar:1 Portaviones, 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                }
                $mensajeContrincante = "Espera a que el HOST coloque sus barcos.";
                include "./vistas/mostrarPartida.php";
                break;
        case 2: $mensaje;
                switch($this->ultimoBarcoInsertado($idPartida,$usuario)){
                        case "Portaviones": $mensaje = "Barcos a colocar: 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                        case "Acorazado":$mensaje = "Barcos a colocar: 2 Cruceros y 3 Destructores.";
                                            break;
                        case "Crucero1": $mensaje = "Barcos a colocar: 1 Crucero y 3 Destructores.";
                                            break;
                        case "Crucero2": $mensaje = "Barcos a colocar: 3 Destructores.";
                                            break;
                        case "Destructor1": $mensaje = "Barcos a colocar: 2 Destructores.";
                                            break;
                        case "Destructor2": $mensaje = "Barcos a colocar: 1 Destructor.";
                                            break;
                        case "Destructor3": $mensaje = "Espera hasta que el rival coloque los barcos.";
                                            break;
                        case false: $mensaje = "Barcos a colocar:1 Portaviones, 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                }
                $mensajeHost = "Espera a que el Contrincante coloque sus barcos.";
                include "./vistas/mostrarPartidaHostBarcosPreparados.php";
                break;
    }


    

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