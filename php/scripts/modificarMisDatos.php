<?php

include "../libs/myLib.php";

if (!empty($_POST['idUsuario']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['pass']) && !empty($_POST['telefono'])) {

    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $pass = md5($_POST['pass']);
    $telefono = $_POST['telefono'];
    
    $conexion = dbConnect();
    $sql = "UPDATE usuario SET nombre='$nombre', apellidos='$apellidos', correo='$correo', password='$pass', telefono='$telefono' WHERE id=$idUsuario;";
    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if ($resultado) {
        salir2("Se han guardado los cambios correctamente", 0, "modificarMisDatos.php");
    } else {
        salir2("No se ha podido guardar los cambios", -1, "modificarMisdatos.php");
    }
}

?>