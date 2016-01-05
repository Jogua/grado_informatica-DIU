<?php

include '../libs/myLib.php';

$idReserva = $_POST['idReserva'];

$conn = dbConnect();
$sql = "DELETE FROM empresa_usa_sala WHERE id=$idReserva";

$resultado = mysqli_query($conn, $sql);
if ($resultado) {
    salir2("La reserva se ha cancelado correctamente", 0, "misSalas.php");
} else {
    salir2("Ha ocurrido un error. Vuelve a intentarlo", -1, "reservarSala.php");
}
mysqli_close($conn);

