<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/login.css"  media="screen,projection"/>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

      <div class="container center-align" style="width:500px" id="formulario">
        <form action="registrarUsuario.php" method="post">
        
            
            <img class="responsive-img" style="text-align:center" src="../img/logo.png">
            <h4 class="left-align"> Formulario de registro </h4>
            <input type="text" name="registroUsuario" class="input-field" placeholder="Introducir usuario.." value="">
            <input type="text" name="registroContraseña" class="input-field" placeholder="Introducir contraseña.." value="">
            <input type="submit" class="waves-effect waves-light btn" name="registrarUsuario" value="Registrarse">
            <button class="waves-effect waves-light btn" name="loginUsuario" value="Login"><a class="black-text" href="./login.php">Iniciar sesión</a></button>

            <?php
                if($registrado==false && isset($_POST['registrarUsuario'])){
                    echo "<p class='flow-text' style='font-size:20px'>Error al registrar el usuario.</p>";
                } else if($registrado==true && isset($_POST['registrarUsuario'])){
                    echo "<p class='flow-text' style='font-size:20px'>Usuario creado correctamente.</p>";

                }
            ?>
        
        </form>
        </div>

        

        <script type="text/javascript" src="../js/materialize.min.js"></script>

</body>
</html>