<?php

include '../libs/myLib.php';

$idEvento = $_POST['idEvento'];

$conn = dbConnect();
$sql = "UPDATE evento SET estado=1 WHERE id=$idEvento";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    salir2("El evento se ha cancelado correctamente. ", 0, "eventosCreados.php");
} else {
    salir2("Ha ocurrido un error. Vuelve a intentarlo. ", -1, "eventosCreados.php");
}
mysqli_close($conn);

