<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

        <div class="container center-align " style="width:500px;" id="formulario">
            <form action="index.php" method="post">
            
                <img class="responsive-img" style="text-align:center"  src="./img/logo.png">
                <input type="hidden" name="op" value="menuPrincipal">
                <?php $partidas = $this->listaPartidas(); ?>
                <table class="striped highlight centered responsive-table">
                    <thead>
                        <tr>
                            <th>Nombre Partida</th>
                            <th>Host</th>
                            <th>Contrincante</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for ($i=0; $i < count($partidas) ; $i++) { 
                            $values = $partidas[$i]->getValueS();
                            echo "<tr>
                                    <td>$values[4]</td>
                                    <td>$values[1]</td>
                                    ";if($values[2] == null){
                                        echo "<td><button type='submite' class='waves-effect waves-light btn' name='partidaSeleccionada' value='$values[0]'>Unirse<i class='large material-icons right'>arrow_forward</i></button>";
                                     } else{
                                         echo "<td>$values[2]</td>";
                                     }
                                    echo "
                                    <td>$values[3]</td>
                                   
                                 </tr>";
                        } ?>
                    </tbody>
                </table>
                
                <button type="submit" class=" waves-effect waves-light btn" name="volverAlMenu" value="volverAlMenu">Volver al menú<i class="large material-icons right">arrow_back</i></button>

                
            </form>
        </div>
        <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>
</html>