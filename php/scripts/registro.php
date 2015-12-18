<?php

include "../libs/myLib.php";

if (!isset($_SESSION['correo'])) {//Si no se puede acceder a $_SESSION['correo'] es porque hace falta iniciar sesión.
    session_start();
}

$correo = $_POST['correo'];
$pass = md5($_POST['pass']);
$pass2 = md5($_POST['pass2']);

if (!empty($correo) && !empty($pass) && !empty($pass2)) {
    if ($pass != $pass2) {
        salir2("Las contraseñas no coinciden", -1, 0);
    } else {
        $nombre = "";
        $apellidos = "";
        $telefono = "";

        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (!empty($_POST['apellidos'])) {
            $apellidos = $_POST['apellidos'];
        }
        if (!empty($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
        }

        $conexion = dbConnect();
        $sql = "INSERT INTO usuario (nombre, apellidos, correo, password, telefono) VALUES ('" . $nombre . "', '" .
                $apellidos . "', '" . $correo . "', '" . $pass . "', '" . $telefono . "');";

        $resultado = mysqli_query($conexion, $sql);

        if (!$resultado) {
            mysqli_close($conexion);
            salir2("El usuario ya existe", -1, 0);
        } else {
            $_SESSION['correo'] = $correo; //Con esto iniciará conexión automaticamente.
            $_SESSION['idUsuario'] = mysqli_insert_id($conexion);
            mysqli_close($conexion);
            //Si hace falta más datos para la sesión sólo hay que añadirlos aquí.
            salir2("Se ha registrado correctamente", 0, "index.php");
        }
    }
}
