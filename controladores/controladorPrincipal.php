<?php

require_once("./controladores/controladorUsuarios.php");
require_once("./controladores/controladorMenu.php");
require_once("./controladores/controladorPartida.php");

class ControladorPrincipal 
{

public function __construct(){
   
}


public function controlarOpcion(){
    
    
    $usuarios = new Usuarios();
    $menuPrincipal = new Menu();
    $partida = new Partida();

    
   
    if(isset($_POST['op'])){
        $opcion = $_POST['op'];
        
        switch($opcion){
            case 'login':
                        unset($_SESSION['partida']);
                        if(isset($_REQUEST['loginDone'])){
                            if($usuarios->comprobarUsuario($_REQUEST['loginUsuario'],$_REQUEST['loginContraseña'])){
                                $_SESSION['usuario'] = $_REQUEST['loginUsuario'];
                                $_SESSION['idUsuario'] = $usuarios->comprobarUsuario($_REQUEST['loginUsuario'],$_REQUEST['loginContraseña']);
                                $menuPrincipal->mostrarMenu();
                            } else{
                                $usuarios->mostrarLogin();
                            }
                        } else if(isset($_REQUEST['registrarse'])){
                            $usuarios->mostrarRegistro(false);
                        } else if(isset($_REQUEST['registrarUsuario'])){
                            if($usuarios->añadirUsuario($_REQUEST['registroUsuario'],$_REQUEST['registroContraseña'])){
                                $usuarios->mostrarRegistro(true); 
                            } else{
                                $usuarios->mostrarRegistro(false); 
                            }      
                        } else if(isset($_REQUEST['loginAgain'])){
                            $usuarios->mostrarLogin();
                        }
                        break;
            case 'menuPrincipal': 
                        unset($_SESSION['partida']);

                        if(isset($_REQUEST['nuevaPartida'])){
                            $menuPrincipal->mostrarNuevaPartida();
                        }else if(isset($_REQUEST['volverAlMenu'])){
                               $menuPrincipal->mostrarMenu();
                        }else if(isset($_REQUEST['crearPartida'])){
                            if($menuPrincipal->crearPartida($usuarios->idUsuario($_SESSION['usuario']),$_REQUEST['nombrePartida'],$_REQUEST['contraseñaPartida'])){
                               $menuPrincipal->mostrarPartidasEnCurso($usuarios->idUsuario($_SESSION['usuario']));
                            } else{
                               $menuPrincipal->mostrarNuevaPartida();
                            }
                        } else if(isset($_REQUEST['listaPartidas'])){
                            $menuPrincipal->mostrarPartidas($usuarios->idUsuario($_SESSION['usuario']));
                          
                        } else if(isset($_REQUEST['Salir'])){
                            session_destroy();
                            $usuarios->mostrarLogin();
                        } else if(isset($_REQUEST['partidaSeleccionada'])){
                            if($menuPrincipal->unirseAPartida($_REQUEST['partidaSeleccionada'],$usuarios->idUsuario($_SESSION['usuario']))){
                                $menuPrincipal->cambiarEstado($_REQUEST['partidaSeleccionada'],1);
                                $menuPrincipal->mostrarPartidasEnCurso($usuarios->idUsuario($_SESSION['usuario']));
                            }
                        } else if(isset($_REQUEST['borrarPartida'])){
                            if($menuPrincipal->borrarPartida($_REQUEST['borrarPartida'])){
                                $menuPrincipal->mostrarPartidas($usuarios->idUsuario($_SESSION['usuario']));
                            }
                        } else if(isset($_REQUEST['partidasEnCurso'])){
                            $menuPrincipal->mostrarPartidasEnCurso($_SESSION['idUsuario']);
                        } else if(isset($_REQUEST['entrarPartida'])){
                            $partida->crearTableros($_REQUEST['entrarPartida']);
                           
                        }
                        break;
            case 'partida': 
                        if(isset($_REQUEST['volverAlMenu'])){
                            
                            $menuPrincipal->mostrarMenu();

                        } else if(isset($_REQUEST['casilla'])){
                            $partida->handlerCasilla($_REQUEST['casilla'],$_REQUEST['idPartida']);
                        } else if(isset($_REQUEST['horizontal'])){
                            $_SESSION['direccion'] = "horizontal";
                            $partida->mostrarPartida($_REQUEST['idPartida']);
                        } else if(isset($_REQUEST['vertical'])){
                            $_SESSION['direccion'] = "vertical";
                            $partida->mostrarPartida($_REQUEST['idPartida']);
                        }
                        break;
                           
        }



    } else if(isset($_SESSION['partida'])){
        $partida->mostrarPartida($_SESSION['partida']);
    } else if(isset($_SESSION['usuario'])){
        $menuPrincipal->mostrarMenu();
        
    } else{$usuarios->mostrarLogin();}
    





}
    
}