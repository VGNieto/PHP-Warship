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
                <div class="input-field col s6">
                    <i class="material-icons prefix">videogame_asset</i>
                    <input type="text" id="icon_prefix" name="nombrePartida" class="input-field validate"  value="">
                    <label for="icon_prefix">Nombre de la Partida</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">lock   </i>
                    <input type="text" id="icon_prefix2" name="contraseñaPartida" class="input-field" value="">
                    <label for="icon_prefix2">Contraseña (opcional)</label>
                </div>
                <button type="submit" class=" waves-effect waves-light btn" name="crearPartida" value="crearPartida">Crear Partida <i class="material-icons right">create</i></button>
                <button type="submit" class=" waves-effect waves-light btn" name="volverAlMenu" value="volverAlMenu">Volver al menú<i class="large material-icons right">arrow_back</i></button>

                
            </form>
        </div>
        <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>
</html>