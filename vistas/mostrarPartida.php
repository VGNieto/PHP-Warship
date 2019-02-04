<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection" />
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
    
    <div class="container row center-align " style="width:500px;" id="formulario">
            <img class="responsive-img col s12" style="text-align:center" src="./img/logo.png">
            <input type="hidden" name="op" value="partida">
    </div>

    <div class="container row">
        <form action="index.php" method="post">
            <div class="col s6 left blue lighten-4 ">
                <h5 style="font-family:Courier New, Courier, monospace;" class="center-align">TU TABLERO</h5>
                <table class="centered responsive-table">
                
                    <thead>
                        <tr>
                            <th> </th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>E</th>
                            <th>F</th>
                            <th>G</th>
                            <th>H</th>
                            <th>I</th>
                            <th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                            
                            
                            $contador = 0;
                            for($j = 0; $j<10;$j++){
                                echo "<tr>";                        
                                echo "<td>".$tableros[0][$j][2]."</td>";
                                for($i =$contador; $i<$contador+10;$i++){
                                    echo "<td id=".$tableros[0][$i][1]."".$tableros[0][$i][2]."><img src='img/agua.png' width=30px height=30px style='opacity:0.4;' alt='submit'></td>";
                                }
                                $contador+=10;
                            echo "</tr>";
                            }

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col s6 right blue lighten-2">
                <h5 style="font-family:Courier New, Courier, monospace;" class="center-align">TABLERO ENEMIGO</h5>  
                <table class="centered responsive-table ">
                
                    <thead>
                        <tr>
                            <th> </th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>E</th>
                            <th>F</th>
                            <th>G</th>
                            <th>H</th>
                            <th>I</th>
                            <th>J</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                            $contador = 0;
                            for($j = 0; $j<10;$j++){
                                
                                echo "<tr>";                        
                                echo "<td>".$tableros[1][$j][2]."</td>";

                                for($i =$contador; $i<$contador+10;$i++){
                                    echo "<td id=".$tableros[1][$i][1]."".$tableros[1][$i][2]."><input type='image' src='img/agua.png' width=30px height=30px style='opacity:0.4;' alt='submit'></td>";
                                }
                                $contador+=10;
                            echo "</tr>";
                            }

                        ?>
                    </tbody>
                </table>
            </div>
            
        </form>
    </div>
    
    <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>

</html>