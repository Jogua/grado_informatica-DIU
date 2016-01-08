<?php

function dbConnect() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "diu";
// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function invertirFecha($fecha) {
    $fechaArray = explode("-", $fecha);
    $fecha = $fechaArray[2] . "-" . $fechaArray[1] . "-" . $fechaArray[0];
    return $fecha;
}

function RandomString($length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE) {
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if ($uc == 1)
	$source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($n == 1)
	$source .= '1234567890';
    if ($sc == 1)
	$source .= '|@#~$%()=^*+[]{}-_';
    if ($length > 0) {
	$rstr = "";
	$source = str_split($source, 1);
	for ($i = 1; $i <= $length; $i++) {
	    mt_srand((double) microtime() * 1000000);
	    $num = mt_rand(1, count($source));
	    $rstr .= $source[$num - 1];
	}
    }
    return $rstr;
}

function salir($str, $url) {
    echo '<script>
            alert("' . $str . '");
            location.href= " ' . $url . '";
        </script>';
}

function salir2($str, $code, $url) {
    switch ($code) {
	case '0':
	    echo '<script>document.getElementById("resultado").className = "alertas animated slideInDown";</script>';
	    echo '<div class="alert alert-success alert-dismissible animated slideInDown" role="alert">';
	    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	    echo '<strong>' . $str . '</strong>';
	    if ($url != '0') {
		echo ' En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="' . $url . '" class="alert-link">enlace</a>';
	    }
	    echo '</div>';
	    echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 2000);</script>';
	    if ($url != '0') {
		echo '<script>
        setTimeout(function () {
           window.location.href = "' . $url . '";}, 3000);</script>';
	    }
	    break;
	case '-1':
	    echo '<script>document.getElementById("resultado").className = "alertas animated slideInDown";</script>';
	    echo '<div class="alert alert-danger alert-dismissible animated slideInDown" role="alert">';
	    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	    echo '<strong>' . $str . '</strong>';
	    if ($url != '0') {
		echo 'En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="' . $url . '" class="alert-link">enlace</a>';
	    }
	    echo '</div>';
	    echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 3000);</script>';
	    if ($url != '0') {
		echo '<script>
         setTimeout(function () {
            window.location.href = "' . $url . '";}, 3000);</script>';
	    }
	    break;
	default:
	    echo '<script>document.getElementById("resultado").className = "alertas animated slideInDown";</script>';
	    echo '<div class="alert alert-danger alert-dismissible animated slideInDown" role="alert">';
	    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	    echo '<strong>Si estás viendo esto es porque algo muy malo acaba de pasar.</strong>';
	    if ($url != '0') {
		echo 'En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="' . $url . '" class="alert-link">enlace</a>';
	    }
	    echo '</div>';
	    echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 3000);</script>';
	    if ($url != '0') {
		echo '<script>
         setTimeout(function () {
            window.location.href = "' . $url . '";}, 3000);</script>';
	    }
	    break;
    }
}

function cargarBotonesMiCuenta($tipoUsuario) {
    if ($tipoUsuario == 'Administrador') {
	?>
	<ul class="list-inline botonesMiCuenta">
	    <li><a class=" btn btn-default" id="button1" href="gestionSalas.php" role="button">Gestión de salas</a></li>
	    <li><a class=" btn btn-default" id="button2" href="#" role="button">Gestión de eventos</a></li>
	    <li><a class=" btn btn-default" id="button3" href="#" role="button">Gestión de empresas</a></li>
	    <li><a class=" btn btn-default" id="button4" href="#" role="button">Modificar mis datos</a></li>
	</ul>
	<?php
    } else if ($tipoUsuario == 'Empresa') {
	?>
	<ul class="list-inline botonesMiCuenta">
	    <li><a class=" btn btn-default" id="button1" href="misSalas.php" role="button">Mis salas</a></li>
	    <li><a class=" btn btn-default" id="button2" href="misEventos.php" role="button">Mis eventos</a></li>
	    <li><a class=" btn btn-default" id="button3" href="#" role="button">Modificar datos empresa</a></li>
	    <li><a class=" btn btn-default" id="button4" href="#" role="button">Modificar mis datos</a></li>
	</ul>
	<?php
    } else if ($tipoUsuario == 'Organizador') {
	?>
	<ul class="list-inline botonesMiCuenta">
	    <li><a class=" btn btn-default" id="button1" href="misSalas.php" role="button">Mis salas</a></li>
	    <li><a class=" btn btn-default" id="button2" href="misEventos.php" role="button">Mis eventos</a></li>
	    <li><a class=" btn btn-default" id="button3" href="#" role="button">Modificar mis datos</a></li>
	</ul>
	<?php
    } else if ($tipoUsuario == 'Usuario') {
	?>
	<ul class="list-inline botonesMiCuenta">
	    <li><a class=" btn btn-default" id="button1" href="#" role="button">Dar de alta Empresa</a></li>
	    <li><a class=" btn btn-default" id="button2" href="#" role="button">Mis eventos</a></li> <!--Eventos a los que estoy apuntado-->
	    <li><a class=" btn btn-default" id="button3" href="#" role="button">Modificar mis datos</a></li>
	</ul>
	<?php
    }
}
