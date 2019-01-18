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
    <link type="text/css" rel="stylesheet" href="./css/menuprincipal.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
</head>
<body>
    <?php    
        if(isset($_SESSION['usuario'])){
           ?>
           <div class="container center-align "  style="width:500px;" id="formulario">
            <form action="index.php" method="post">
                <img class="responsive-img" style="text-align:center"  src="./img/logo.png">
                <div id="menu" class="z-depth-5 teal blue">  
                    <h4 class="center-align">Menu principal </h4>
                    <div class="collection">
                        <a class="collection-item" href="">Nueva partida</a></button>
                        <a class="collection-item" href="">Lista de partidas</a></button>
                        <a class="collection-item" href="">Entrar con codigo</a></button>
                        <a class="collection-item" href="">Opciones</a></button>
                        <a class="collection-item" href="./login.php">Salir</a></button>
                        <input class="collection-item" type="submit" name="op" value="Salir" >
                    </div>
                </div>
            </form>
            </div>
            <?php
        }
            ?>
    ?>
    
    
    
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    
</body>
</html>