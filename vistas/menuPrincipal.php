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
    <link type="text/css" rel="stylesheet" href="./css/menuprincipal.css" media="screen,projection" />
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
        if(isset($_SESSION['usuario'])){
           ?>
    <div class="container center-align " style="width:500px;" id="formulario">
        <form action="index.php" method="post">
            <img class="responsive-img" style="text-align:center" src="./img/logo.png">
            <div id="menu" class="z-depth-5 teal blue">
                <h4 class="center-align white-text" style="font-family: Impact, Charcoal, sans-serif">Menú principal
                </h4>

                <input type="hidden" name="op" value="menuPrincipal">
                <button type="submit" class=" waves-effect waves-light btn" style="width:100%;" name="nuevaPartida"
                    value="Nueva Partida">Nueva Partida <i class="material-icons right">fiber_new</i></button><br><br>
                <button type="submit" class=" waves-effect waves-light btn" style="width:100%;" name="listaPartidas"
                    value="Lista Partidas">Lista de Partidas<i
                        class="material-icons right">format_list_bulleted</i></button><br><br>
                <button type="submit" class=" waves-effect waves-light btn" style="width:100%;" name="partidasEnCurso"
                    value="Partidas en Curso">Partidas en Curso <i
                        class="material-icons right">format_list_bulleted</i></button><br><br>
                <button type="submit" class=" waves-effect waves-light btn" style="width:100%;" name="Salir"
                    value="Salir">Salir <i class="material-icons right">cancel</i></button><br><br>

            </div>

    </div>
    <?php
        }
            ?>


    <script type="text/javascript" src="./js/materialize.min.js"></script>

</body>

</html>