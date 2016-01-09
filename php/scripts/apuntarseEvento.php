<?php

include '../libs/myLib.php';

if (!isset($_SESSION['idUsuario'])) {
    session_start();
}

$idEvento = $_GET['id'];
$idUsuario = $_SESSION['idUsuario'];

$conn = dbConnect();
$sql = "INSERT INTO usuario_asiste_evento (idUsuario,idEvento) "
        . " VALUES ($idUsuario,$idEvento);";
$resultado = mysqli_query($conn, $sql);
if ($resultado) {
    salir2("Se ha apuntado al evento correctamente.", 0, "eventos.php");
} else {
    salir2("Ha ocurrido un error. Vuelve a intentarlo", -1, "eventos.php");
}

mysqli_close($conn);