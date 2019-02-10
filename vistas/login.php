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

    <div class="container center-align " style="width:500px;" id="formulario">
        <form action="index.php" method="post">

            <img class="responsive-img" style="text-align:center" src="./img/logo.png">
            <input type="hidden" name="op" value="login">
            <div id="menu" class="z-depth-5 white">
                <div class="input-field col s6">
                    <i class="material-icons prefix black-text">account_circle</i>
                    <input type="text" id="icon_prefix" name="loginUsuario" class="input-field validate" value="">
                    <label for="icon_prefix" class="black-text">Usuario</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix black-text">lock </i>
                    <input type="text" id="icon_prefix2" name="loginContraseña" class="input-field" value="">
                    <label for="icon_prefix2" class="black-text">Contraseña</label>
                </div>
            </div>
            <button type="submit" class=" waves-effect waves-light btn red darken-1" name="loginDone" value="Iniciar Sesión">Iniciar
                Sesión <i class="material-icons right ">send</i></button>
            <button type="submit" class=" waves-effect waves-light btn  blue accent-2" name="registrarse"
                value="Registrarse">Registrarse <i class="large material-icons right">contacts</i></button>

            <?php
                    if(isset($_POST['loginDone'])){
                        echo "<p class='flow-text white-text' style='font-size:20px'>No existe el usuario amigo.</p>";
                    }
                ?>
        </form>
    </div>

</body>

</html>