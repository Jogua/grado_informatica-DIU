<?php

include "../libs/myLib.php";

if (!empty($_POST['idSala']) && !empty($_POST['descripcion']) && !empty($_POST['ubicacion']) && !empty($_POST['capacidad'])) {
    $idSala = $_POST['idSala'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $subidaCorrecta = false;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
	if ($_FILES['imagen']['error'] > 0) {
	    salir2("Ha ocurrido un error en la carga de la imagen", -1);
	} else {
	    $permitidos = array("image/jpg", "image/jpeg", "image/png");
	    $limite_kb = 2048;
	    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
		$carpeta = "../../assets/images/salas";
		if (!is_dir($carpeta)) {
		    mkdir($carpeta);
		}
		$formato = "." . split("/", $_FILES['imagen']['type'])[1];
		$nombreArchivo = "sala_" . $idSala . $formato;
		$ruta = $carpeta . "/" . $nombreArchivo;
		$ruta_old = $carpeta . "/sala_" . $idSala . "_old" . $formato;
		rename($ruta, $ruta_old);
		$subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
	    } else {
		salir2("La imagen no tiene un formato apropiado o su tamaño es superior a 2MB", -1, 0);
	    }
	}
    }
    $conexion = dbConnect();
    $sql = "UPDATE sala SET descripcion='$descripcion', ubicacion='$ubicacion', capacidad=$capacidad WHERE id=$idSala;";
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
	salir2("Se han guardado los cambios correctamente", 0, "gestionSalas.php");
    }
}