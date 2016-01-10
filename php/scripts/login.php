<?php

include_once "../libs/myLib.php";

if (!empty($_POST['correo']) && !empty($_POST['password'])) {
    $correo = $_POST['correo'];
    $pass = md5($_POST['password']);

    $conexion = dbConnect();
    $sql = "SELECT * FROM usuario WHERE usuario.correo='$correo'";
    $resultado = mysqli_query($conexion, $sql);

    if (($row = mysqli_fetch_array($resultado))) {
	if ($row['password'] == $pass) {
	    session_start();
	    $_SESSION['correo'] = $correo;
	    $_SESSION['idUsuario'] = $row['id'];
	    mysqli_close($conexion);
	    salir2("Se ha iniciado sesión correctamente", 0, "miCuenta.php");
	} else {
	    mysqli_close($conexion);
	    salir2("El nombre de usuario o la contraseña no son correctos", -1, 0);
	}
    } else {
	mysqli_close($conexion);
	salir2("No existe ese usuario en el sistema", -1, 0);
    }
}
?>