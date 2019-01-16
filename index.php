<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    <?php

        require("./modelos/dbJugador.php");
        require("./modelos/jugador.php");

        $operaciones = new dbJugador();
        $jugador1 = new Jugador("victor","tonto");
        $operaciones->añadirJugador($jugador1);


    ?>


    
</body>
</html>