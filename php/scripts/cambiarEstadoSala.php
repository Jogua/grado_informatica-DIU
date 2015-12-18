<?php

include "../libs/myLib.php";

if (!empty($_POST['idSala']) && isset($_POST['value'])) {
    $idSala = $_POST['idSala'];
    $value = $_POST['value'];

    $conexion = dbConnect();
    $sql = "UPDATE sala SET estado=$value WHERE id=$idSala;";
    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if ($resultado) {
	salir2("La sala se ha dado de alta correctamente", 0, $_SERVER['HTTP_REFERER']);
    } else {
	salir2("No se ha podido dar de alta a la sala.", -1, "gestionSalas.php");
    }
}
