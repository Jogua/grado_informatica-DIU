<?php

include "../libs/myLib.php";

if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['ubicacion']) && !empty($_POST['capacidad']) && !isset($_POST['imagen'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    
    if ($_FILES['imagen']['name']) {
	if ($_FILES['imagen']['error'] > 0) {
	    salir2("Ha ocurrido un error en la carga de la imagen", -1, 0);
	} else {
	    $permitidos = array("image/jpg", "image/jpeg", "image/png");
	    $limite_kb = 2048;
	    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
		$carpeta = "../../assets/images/salas";
		if (!is_dir($carpeta)) {
		    mkdir($carpeta);
		}
		$formato = "." . split("/", $_FILES['imagen']['type'])[1];
		$nombreArchivo = "sala_" . RandomString(4) . $formato;
		$ruta_old = $carpeta . "/" . $nombreArchivo;
		$subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_old);
		
		$conexion = dbConnect();
		$sql = "INSERT INTO sala (nombre, descripcion, ubicacion, capacidad) "
			. " VALUES ('$nombre', '$descripcion', '$ubicacion', '$capacidad');";
		mysqli_query($conexion, $sql);
		$idSala = mysqli_insert_id($conexion);
		$nombreArchivo = "sala_" . $idSala . $formato;
		$ruta = $carpeta . "/" . $nombreArchivo;
		$rutaImagenBD = substr($ruta, 6);
		rename($ruta_old, $ruta);
		$sql = "UPDATE sala SET imagen='$rutaImagenBD';";
		$resultado = mysqli_query($conexion, $sql);
		mysqli_close($conexion);
		if (!$resultado) {
		    if ($subidaCorrecta) {//Si no se ha podido registrar borra la foto en caso de que se haya subido.
			unlink($ruta);
		    }
		    salir2("No se han podido guardar los cambios", -1, 0);
		} else {
		    salir2("Sala añadida correctamente", 0, "gestionSalas.php");
		}
	    } else {
		salir2("La imagen no tiene un formato apropiado o su tamaño es superior a 2MB", -1, 0);
	    }
	}
    }
}