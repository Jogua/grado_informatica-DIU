<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoWorking</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/npm.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
    <div id="barraSuperior" class="row">
        <div class="col-md-4">
            <?php
            if($seccion=="inicio"){
                echo '<a href="index.php"><img id="imagenLogo" src="images/coworking-logo.png" alt="Logo Congreso" /></a>';
            }else{
                echo '<a href="../index.php"><img id="imagenLogo" src="../images/coworking-logo.png" alt="Logo Congreso" /></a>';
            }
            ?>
        </div>
        <div class="col-md-8">
            <fieldset>
                <div id="cuadroSesion">
                    <form class="form-inline formularioInicioSesion">
                        <div class="form-group">
                            <label class="sr-only" for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                        </div>
                        <button type="submit" class="btn btn-default">Enviar</button>
                    </form>
                    <?php
                    if($seccion=="inicio"){
                        echo '<a href="php/registro.php">Registrate</a>';
                    }else{
                        echo '<a href="registro.php">Registrate</a>';
                    }
                    ?>
                </div>
            </fieldset>
        </div>
    </div>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <!--boton de menu-->
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" class="logo" alt="CoWorking"></a> <!--logo -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
                     <?php //if(isset($_SESSION)){ echo '<li><a href="#"><i class="fa fa-user usuario"></i>Mi cuenta</a></li>'; } else { echo '<li><a href="signin.php"><i class="fa fa-user usuario"></i>Identifícate</a></li>'; } ?>

              <?php ponerMenu($seccion, "inicio", "Inicio"); ?>
              <?php ponerMenu($seccion, "salas", "Nuestras salas"); ?>
              <?php ponerMenu($seccion, "empresas", "Empresas"); ?>
              <?php ponerMenu($seccion, "eventos", "Eventos"); ?>
              <?php ponerMenu($seccion, "contacto", "Contacto"); ?>
          </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</header>



<?php

function ponerMenu($seccion, $clave, $nombre) {
    if($seccion == "inicio"){
        if ($seccion == $clave) {
            echo '<li class="botonMenu activo"><a href="index.php" role="button">' . $nombre . '</a></li>';
        } else  {
            echo '<li class="botonMenu"><a class="botonMenu" href="php/' . $clave . '.php" role="button">' . $nombre . '</a></li>';
        }
    }else if($clave == "inicio"){ //$seccion no es la activa
        echo '<li class="botonMenu"><a class="botonMenu" href="../index.php" role="button">' . $nombre . '</a></li>';   
    }else if ($seccion == $clave) {
        echo '<li class="botonMenu activo"><a href="' . $clave . '.php" role="button">' . $nombre . '</a></li>';
    } else {
        echo '<li class="botonMenu"><a class="botonMenu" href="' . $clave . '.php" role="button">' . $nombre . '</a></li>';
    }
}
