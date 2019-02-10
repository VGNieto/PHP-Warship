<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <meta http-equiv="refresh" content="10">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./css/mostrarPartida.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
    body {
        background-image: url("./img/fondo3.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
</head>

<body>
        <?php
        $url=$_SERVER['REQUEST_URI'];
        header("Refresh: 4; URL=$url");
        ?>

    <div class="container row center-align " style="width:500px;" id="formulario">
        <img class="responsive-img col s12" style="text-align:center" src="./img/logo.png">
    </div>

    <div class="container row" id="tableros">
        <form action="index.php" method="post">
            <input type="hidden" name="op" value="partida">
            <?php
                echo "<input type='hidden' name='idPartida' value=$idPartida>";
            ?>
            
            <div class="col s12 m12 l6 xl6 left white ">
               
            <h5 class="center-align" id="titulo">TU TABLERO</h5>
            

                <table class="centered responsive-table">
                    <thead>
                        <tr>
                            <th> </th><th>A</th> <th>B</th> <th>C</th><th>D</th> <th>E</th><th>F</th><th>G</th> <th>H</th><th>I</th><th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                
                        if($usuario == $host){
                            echo "<button type='submit' class=' waves-effect waves-light btn col s6 orange darken-3' name='horizontal' value='horizontal'>Horizontal</button>
                    
                            <button type='submit' class=' waves-effect waves-light btn col s6 green accent-3' name='vertical' value='vertical'>Vertical</button>";
                        
                           $filas = [1,2,3,4,5,6,7,8,9,10];
                           $columnas = [1,2,3,4,5,6,7,8,9,10];
                           $posiciones;
                            
                           if($tableros[0]!=false){

                            for($i = 0;$i<count($tableros[0]);$i++){
                                $posiciones[] = $tableros[0][$i][1]."-".$tableros[0][$i][2];
                            }
                            
                                //EL HOST ESTÁ PRIMERO
                                
                                echo "<p id='mensaje'> $mensaje </p>";
                                
                                for($j = 1; $j<=10;$j++){
                                    echo "<tr>";                        
                                    echo "<td>".$filas[$j-1]."</td>";
                                    for($i =1; $i<=10;$i++){
                                        $posicion = $j."-".$i;
                                        
                                        if(in_array($posicion,$posiciones) != false){
                                            
                                            $id = $posicion."-".$_SESSION['idUsuario'];
                                            echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                        } else{
                                            $id = $posicion."-".$_SESSION['idUsuario'];
                                            echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                        }
                                        
                                    }
                                    
                                    echo "</tr>";
                                }
                            } else{
                                echo "<p id='mensaje'> $mensaje </p>";
                                for($j = 1; $j<=10;$j++){
                                    echo "<tr>";                        
                                    echo "<td>".$filas[$j-1]."</td>";
                                    for($i =1; $i<=10;$i++){
                                        $posicion = $j."-".$i;
                                        $id = $posicion."-".$_SESSION['idUsuario'];
                                        echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                    }
                                    
                                    echo "</tr>";
                                }
                            }
                         } else{

                            $filas = [1,2,3,4,5,6,7,8,9,10];
                            $columnas = [1,2,3,4,5,6,7,8,9,10];
                            $posiciones;
                            echo "<p id='mensaje'> $mensajeContrincante </p>";
                            for($j = 1; $j<=10;$j++){
                                echo "<tr>";                        
                                echo "<td>".$filas[$j-1]."</td>";
                                for($i =1; $i<=10;$i++){
                                    $posicion = $j."-".$i;
                                    $id = $posicion."-".$_SESSION['idUsuario'];
                                    echo "<td><button type='submit' disabled id='casillaAgua' name='casilla' value='$id'></button></td>";
                                }
                                
                                echo "</tr>";
                            }
                        }
                         
                         
                         ?>

                </table>
                    
            </div>

            <div class="col s12 m12 l6 xl6 right white ">
                <h5 class="center-align" id="titulo">TABLERO RIVAL</h5>
                <br>
                <table class="centered responsive-table">
                    <thead>
                        <tr>
                            <th> </th><th>A</th> <th>B</th> <th>C</th><th>D</th> <th>E</th><th>F</th><th>G</th> <th>H</th><th>I</th><th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 

                                
                                $filas = [1,2,3,4,5,6,7,8,9,10];
                                $columnas = [1,2,3,4,5,6,7,8,9,10];
                                $posiciones;
                                
                                for($j = 1; $j<=10;$j++){
                                    echo "<tr>";                        
                                    echo "<td>".$filas[$j-1]."</td>";
                                    for($i =1; $i<=10;$i++){
                                        $posicion = $j."-".$i;
                                        $id = $posicion."-".$_SESSION['idUsuario'];
                                        echo "<td><button type='submit' disabled id='casillaAgua' name='casilla' value='$id'></button></td>";
                                    }
                                    
                                    echo "</tr>";
                                }                         
                         
                         ?>

                </table>
            </div>
            <br> 
            <button type="submit" style="margin-top:15px;" class=" waves-effect waves-light btn col s12 red white-text" name="volverAlMenu" value="volverAlMenu">Volver
                al menú<i class="large material-icons right">arrow_back</i></button>
            </form>
           
    
        
    </div>
    

    <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>

</html>