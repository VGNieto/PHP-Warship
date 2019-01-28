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

    <div class="container center-align" style="width:500px" id="formulario">
        <form action="index.php" method="post">

            <img class="responsive-img" style="text-align:center" src="./img/logo.png">
            <div id="menu" class="z-depth-5 teal blue">
                <input type="hidden" name="op" value="login">
                <div class="input-field col s6">
                    <i class="material-icons prefix white-text">account_circle</i>
                    <input type="text" id="icon_prefix" name="registroUsuario" class="input-field validate" value="">
                    <label for="icon_prefix" class="white-text">Nuevo Usuario</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix white-text">lock </i>
                    <input type="text" id="icon_prefix2" name="registroContraseña" class="input-field" value="">
                    <label for="icon_prefix2" class="white-text">Nueva contraseña</label>
                </div>
            </div>
            <button type="submit" class=" waves-effect waves-light btn" name="registrarUsuario"
                value="Registrarse">Registrar Usuario <i class="large material-icons right">contacts</i></button>
            <button type="submit" class=" waves-effect waves-light btn" name="loginAgain"
                value="Iniciar Sesión">Volver<i class="material-icons right">arrow_back</i></button>

            <?php
              
                if($registrado == true && isset($_REQUEST['registrarUsuario'])){
                    echo "<p class='flow-text' style='font-size:20px'>Registrado correctamente amigo.</p>";
                } else if($registrado == false && isset($_REQUEST['registrarUsuario'])){
                    echo "<p class='flow-text' style='font-size:20px'>No ha podido ser amigo.</p>";

                }

            ?>


        </form>
    </div>



    <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>

</html>