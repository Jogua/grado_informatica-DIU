<?php

include "../libs/myLib.php";

if (!empty($_POST['idEvento']) && !empty($_POST['nombre']) && !empty($_POST['fecha']) && !empty($_POST['hora']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['plazas']) && !empty($_POST['selectSalas'])) {
    $idEvento = $_POST['idEvento'];
    $nombre = $_POST['nombre'];
    $fecha = invertirFecha($_POST['fecha']) . ' ' . $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $plazas = $_POST['plazas'];
    $idSala = $_POST['selectSalas'];
    $subidaCorrecta = false;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
	if ($_FILES['imagen']['error'] > 0) {
	    salir2("Ha ocurrido un error en la carga de la imagen", -1);
	} else {
	    $permitidos = array("image/jpg", "image/jpeg", "image/png");
	    $limite_kb = 2048;
	    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
		$carpeta = "../../assets/images/eventos";
		if (!is_dir($carpeta)) {
		    mkdir($carpeta);
		}
		$formato = "." . split("/", $_FILES['imagen']['type'])[1];
		$nombreArchivo = "evento_" . $idEvento . $formato;
		$ruta = $carpeta . "/" . $nombreArchivo;
		$ruta_old = $carpeta . "/evento_" . $idEvento . "_old" . $formato;
		rename($ruta, $ruta_old);
		$subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
	    } else {
		salir2("La imagen no tiene un formato apropiado o su tamaño es superior a 2MB", -1, 0);
	    }
	}
    }
    $conexion = dbConnect();
    $sql = "UPDATE evento SET nombre='$nombre', fecha='$fecha', descripcion='$descripcion', plazas=$plazas, precio=$precio WHERE id=$idEvento;";
    mysqli_query($conexion, $sql);
    $sql = "UPDATE sala_aloja_evento SET idSala=$idSala WHERE idEvento=$idEvento;";
    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if (!$resultado) {
	if ($subidaCorrecta) {//Si no se ha podido registrar borra la foto en caso de que se haya subido.
	    unlink($ruta);
	    rename($ruta_old, $ruta);
	}
	salir2("No se ha podido guardar los cambios", -1, 0);
    } else {
	if (isset($ruta_old)) {
	    unlink($ruta_old);
	}
	salir2("Se han guardado los cambios correctamente", 0, "eventosCreados.php");
    }
}