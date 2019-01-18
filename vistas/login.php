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
    <link type="text/css" rel="stylesheet" href="./css/login.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

        <div class="container center-align " style="width:500px;" id="formulario">
            <form action="index.php" method="post">
            
                <img class="responsive-img" style="text-align:center"  src="./img/logo.png">
                <h4 class="left-align"> Iniciar sesión </h4>
                <input type="hidden" name="op" value="login">
                <input type="text" name="loginUsuario" class="input-field" placeholder="Introducir usuario.." value="">
                <input type="text" name="loginContraseña" class="input-field" placeholder="Introducir contraseña.." value="">
                <input type="submit" class="waves-effect waves-light btn" name="loginDone" value="Iniciar Sesión">
                <button class="waves-effect waves-light btn" name="registrarUsuario" value="Registrarse"><a class="black-text" href="./registrarUsuario.php">Registrarse</a></button>
                
                <?php
                    if(isset($_POST['loginDone'])){
                        echo "<p class='flow-text' style='font-size:20px'>No existe el usuario amigo.</p>";
                    }
                ?>
            </form>
        </div>
        <script type="text/javascript" src="../js/materialize.min.js"></script>

</body>
</html>