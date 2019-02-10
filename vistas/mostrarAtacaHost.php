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
        header("Refresh: 120; URL=$url");
        $numeros = [1,2,3,4,5,6,7,8,9,10];
        ?>
    <div class="container row center-align " style="width:500px;" id="formulario">  
        <img class="responsive-img col s12" style="text-align:center" src="./img/logo.png">

    </div>
    
    <div class="container row">
        <form action="index.php" method="post">
            <input type="hidden" name="op" value="partida">
            <?php
                echo "<input type='hidden' name='idPartida' value=$idPartida>";
            ?>
            
            <div class="col s12 m12 l6 xl6 left white ">
            <h5 class="center-align" id="titulo">TU TABLERO</h5>
                <table class="centered responsive-table" id="izquierda">
                    <thead>
                        <tr>
                            <th> </th><th>A</th> <th>B</th> <th>C</th><th>D</th> <th>E</th><th>F</th><th>G</th> <th>H</th><th>I</th><th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 

                        if($usuario == $host){

                        
                            unset($posiciones);
                            $posiciones;
                            
                            
                            for($i = 0;$i<count($tableros[0]);$i++){
                                $posiciones[] = $tableros[0][$i][1]."-".$tableros[0][$i][2];
                                
                            }

                            for($i = 0;$i<count($tableros[0]);$i++){
                                $estados[] = $tableros[0][$i][5];
                            }
                            
                            $items = array();
                            for($i=1;$i<=10;$i++){
                                
                                for($z=1;$z<=10;$z++){
                                    $busqueda = $i."-".$z;
                                    if(($valor =  array_search($busqueda,$posiciones)) !== false){
                                        $items[$i][$z] = [$posiciones[$valor],$estados[$valor]];

                                    } else{
                                        $items[$i][$z] = 0;

                                    }

                                }
                            }
                            echo "<p id='mensaje'> $mensaje </p>";
                            foreach($items as $fila=> $row) {
                                echo('<tr>');
                                $valor = $fila-1;
                                echo "<td>$numeros[$valor]</td>";
                                foreach($row as $columna=>$cell) {
                                    
                                    switch($cell[1]){
                                                
                                                case "Portaviones":  $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;               
                                                case "Acorazado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero1": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor1":$id = $cell[0]."-".$_SESSION['idUsuario']; 
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor3":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "aguaTocada": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaAguaTocada' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "barcoTocado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaBarcoTocado' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case 0: $id = $fila."-".$columna."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                
                                            }
                                  
                                }
                                echo('</tr>');
                              }




                         } else{

                            unset($posiciones);
                            $posiciones;
                            
                            
                            for($i = 0;$i<count($tableros[1]);$i++){
                                $posiciones[] = $tableros[1][$i][1]."-".$tableros[1][$i][2];
                                
                            }

                            for($i = 0;$i<count($tableros[1]);$i++){
                                $estados[] = $tableros[1][$i][5];
                            }
                            
                            $items = array();
                            for($i=1;$i<=10;$i++){
                                
                                for($z=1;$z<=10;$z++){
                                    $busqueda = $i."-".$z;
                                    if(($valor =  array_search($busqueda,$posiciones)) !== false){
                                        $items[$i][$z] = [$posiciones[$valor],$estados[$valor]];

                                    } else{
                                        $items[$i][$z] = 0;

                                    }

                                }
                            }
                            echo "<p id='mensaje'> $mensajeContrincante </p>";
                            foreach($items as $fila=> $row) {
                                echo('<tr>');
                                $valor = $fila-1;
                                echo "<td>$numeros[$valor]</td>";
                                foreach($row as $columna=>$cell) {
                                    
                                    switch($cell[1]){
                                                
                                                case "Portaviones":  $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;               
                                                case "Acorazado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero1": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor1":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor3":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaBarco' disabled name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "aguaTocada": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaAguaTocada' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "barcoTocado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaBarcoTocado' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case 0: $id = $fila."-".$columna."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' disabled name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                
                                            }
                                  
                                }
                                echo('</tr>');
                              }
                        }
                         
                         
                         ?>

                </table>
                  
            </div>

            <div class="col s12 m12 l6 xl6 right white ">
            <h5 class="center-align" id="titulo">TABLERO RIVAL</h5>

                <table class="centered responsive-table" id="derecha">
                    <thead>
                        <tr>
                            <th> </th><th>A</th> <th>B</th> <th>C</th><th>D</th> <th>E</th><th>F</th><th>G</th> <th>H</th><th>I</th><th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            if($usuario == $host){

                            
                            unset($posiciones);
                            unset($estados);
                            unset($items);
                            $posiciones;
                            $estados;
                            $items;
                            
                            
                            for($i = 0;$i<count($tableros[1]);$i++){
                                $posiciones[] = $tableros[1][$i][1]."-".$tableros[1][$i][2];
                                
                            }

                            for($i = 0;$i<count($tableros[1]);$i++){
                                $estados[] = $tableros[1][$i][5];
                            }
                            
                            $items = array();
                            for($i=1;$i<=10;$i++){
                                
                                for($z=1;$z<=10;$z++){
                                    $busqueda = $i."-".$z;
                                    if(($valor =  array_search($busqueda,$posiciones)) !== false){
                                        $items[$i][$z] = [$posiciones[$valor],$estados[$valor]];

                                    } else{
                                        $items[$i][$z] = 0;

                                    }

                                }
                            }
                            echo " <br>";
                            foreach($items as $fila=> $row) {
                                echo('<tr>');
                                $valor = $fila-1;
                                echo "<td>$numeros[$valor]</td>";
                                foreach($row as $columna=>$cell) {
                                    
                                    switch($cell[1]){
                                                
                                                case "Portaviones":  $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;               
                                                case "Acorazado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero1": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "Crucero2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor1":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "Destructor3":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;    
                                                case "aguaTocada": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaAguaTocada' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case "barcoTocado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' disabled id='casillaBarcoTocado' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                case 0: $id = $fila."-".$columna."-".$_SESSION['idUsuario'];
                                                                    echo "<td><button type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                    break;   
                                                
                                            }
                                  
                                }
                                echo('</tr>');
                              }
                              


                            } else{
                                unset($posiciones);
                                unset($estados);
                                unset($items);
                                $posiciones;
                                $estados;
                                $items;
                                
                                for($i = 0;$i<count($tableros[0]);$i++){
                                    $posiciones[] = $tableros[0][$i][1]."-".$tableros[0][$i][2];
                                    
                                }

                                for($i = 0;$i<count($tableros[0]);$i++){
                                    $estados[] = $tableros[0][$i][5];
                                }
                                
                                $items = array();
                                for($i=1;$i<=10;$i++){
                                    
                                    for($z=1;$z<=10;$z++){
                                        $busqueda = $i."-".$z;
                                        if(($valor =  array_search($busqueda,$posiciones)) !== false){
                                            $items[$i][$z] = [$posiciones[$valor],$estados[$valor]];

                                        } else{
                                            $items[$i][$z] = 0;

                                        }

                                    }
                                }
                                echo " <br>";

                                foreach($items as $fila=> $row) {
                                    echo('<tr>');
                                    $valor = $fila-1;
                                    echo "<td>$numeros[$valor]</td>";
                                    foreach($row as $columna=>$cell) {
                                        
                                        switch($cell[1]){
                                                    
                                                    case "Portaviones":  $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;               
                                                    case "Acorazado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;   
                                                    case "Crucero1": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;   
                                                    case "Crucero2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;    
                                                    case "Destructor1":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;    
                                                    case "Destructor2":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;    
                                                    case "Destructor3":$id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button disabled type='submit' id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;    
                                                    case "aguaTocada": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button type='submit' disabled id='casillaAguaTocada' name='casilla' value='$id'></button></td>";
                                                                        break;   
                                                    case "barcoTocado": $id = $cell[0]."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button type='submit' disabled id='casillaBarcoTocado' name='casilla' value='$id'></button></td>";
                                                                        break;   
                                                    case 0: $id = $fila."-".$columna."-".$_SESSION['idUsuario'];
                                                                        echo "<td><button type='submit' disabled id='casillaAgua' name='casilla' value='$id'></button></td>";
                                                                        break;   
                                                    
                                                }
                                    
                                    }
                                    echo('</tr>');
                                }
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