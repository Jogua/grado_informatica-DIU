<?php

include '../libs/myLib.php';

$idEvento = $_POST['idEvento'];

$conn = dbConnect();
$sql = "DELETE FROM usuario_asiste_evento WHERE `idEvento`=$idEvento";
mysqli_query($conn, $sql);
$sql = "DELETE FROM sala_aloja_evento WHERE `idEvento`=$idEvento";
mysqli_query($conn, $sql);
$sql = "DELETE FROM evento WHERE id=$idEvento";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    salir2("El evento se ha cancelado correctamente", 0, "eventosCreados.php");
} else {
    salir2("Ha ocurrido un error. Vuelve a intentarlo", -1, "eventosCreados.php");
}
mysqli_close($conn);

