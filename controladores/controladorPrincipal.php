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
    //$partida = new Partida();
   
    if(isset($_POST['op'])){
        $opcion = $_POST['op'];

        switch($opcion){
            case 'login':
                        if(isset($_REQUEST['loginDone'])){
                            if($usuarios->comprobarUsuario($_REQUEST['loginUsuario'],$_REQUEST['loginContraseña'])){
                                $_SESSION['usuario'] = $_REQUEST['loginUsuario'];
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
                        if(isset($_REQUEST['nuevaPartida'])){
                            $menuPrincipal->mostrarNuevaPartida();
                        }else if(isset($_REQUEST['volverAlMenu'])){
                               $menuPrincipal->mostrarMenu();
                        }else if(isset($_REQUEST['crearPartida'])){
                            if($menuPrincipal->crearPartida($usuarios->idUsuario($_SESSION['usuario']),$_REQUEST['nombrePartida'],$_REQUEST['contraseñaPartida'])){
                                //$partidas->mostrarPartida($id);
                            } else{
                               $menuPrincipal->mostrarNuevaPartida();
                            }
                        } else if(isset($_REQUEST['Salir'])){
                            session_destroy();
                            $usuarios->mostrarLogin();
                        } 
                           
        }



    }else{
        $usuarios->mostrarLogin();
    }
    





}
    
}
