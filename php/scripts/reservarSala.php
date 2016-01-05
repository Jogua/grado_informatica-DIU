<?php

include '../libs/myLib.php';

$idEmpresa = $_POST['idEmpresa'];
$idSala = $_POST['idSala'];
$fechaInicioArray = explode("-", $_POST['fechaInicio']);
$fechaFinArray = explode("-", $_POST['fechaFin']);
$fechaInicio = $fechaInicioArray[2] . "-" . $fechaInicioArray[1] . "-" . $fechaInicioArray[0];
$fechaFin = $fechaFinArray[2] . "-" . $fechaFinArray[1] . "-" . $fechaFinArray[0];

$conn = dbConnect();
$sql = "SELECT * FROM empresa_usa_sala WHERE idSala=$idSala AND ((fechaInicio>='$fechaInicio' AND fechaInicio<'$fechaFin') OR (fechaFin>'$fechaInicio' AND fechaInicio<='$fechaFin'));";

$resultado = mysqli_query($conn, $sql);
if ($resultado) {
    if (mysqli_num_rows($resultado) == 0) { //Correcto
	$sql = "INSERT INTO empresa_usa_sala (idEmpresa,idSala,fechaInicio,fechaFin) "
		. " VALUES ($idEmpresa,$idSala,'$fechaInicio','$fechaFin');";
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
	    salir2("La sala ha sido reservada", 0, "misSalas.php");
	} else {
	    salir2("Ha ocurrido un error. Vuelve a intentarlo", -1, "reservarSala.php");
	}
    } else {//Ya está reservada
	salir2("La sala ya está reservada", -1, "reservarSala.php");
    }
}
mysqli_close($conn);
