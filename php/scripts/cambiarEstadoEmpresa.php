<?php

include "../libs/myLib.php";

if (!empty($_POST['idEmpresa']) && isset($_POST['value'])) {
    $idEmpresa = $_POST['idEmpresa'];
    $value = $_POST['value'];

    $conexion = dbConnect();
    $sql = "UPDATE empresa SET estado=$value WHERE id=$idEmpresa;";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
	$sql = "SELECT * FROM empresa WHERE id=$idEmpresa;";
	$resultado = mysqli_query($conexion, $sql);
	if ($resultado) {
	    $row = mysqli_fetch_array($resultado);
	    if ($value) {
		$sql = "UPDATE usuario SET tipo='" . $row['tipo'] . "' WHERE idEmpresa=$idEmpresa;";
		mysqli_query($conexion, $sql);
	    } else {
		$sql = "UPDATE usuario SET tipo='Usuario' WHERE idEmpresa=$idEmpresa;";
		mysqli_query($conexion, $sql);
	    }
	    salir2("La sala se ha dado de alta correctamente", 0, $_SERVER['HTTP_REFERER']);
	} else {
	    salir2("No se ha podido dar de alta a la sala.", -1, "gestionEmpresas.php");
	}
    } else {
	salir2("No se ha podido dar de alta a la sala.", -1, "gestionEmpresas.php");
    }
    mysqli_close($conexion);
}
