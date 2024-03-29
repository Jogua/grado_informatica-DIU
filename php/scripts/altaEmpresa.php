<?php

include "../libs/myLib.php";



if (!empty($_POST['idUsuario']) && !empty($_POST['nombre']) && !empty($_POST['cif']) && !empty($_POST['descripcion']) && !empty($_POST['web']) && !isset($_POST['imagen'])) {
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $cif = $_POST['cif'];
    $descripcion = $_POST['descripcion'];
    $web = $_POST['web'];
    if (isset($_POST['checkbox'])) {
	$rol = 'Organizador';
    } else {
	$rol = 'Empresa';
    }
    if ($_FILES['imagen']['name']) {
	if ($_FILES['imagen']['error'] > 0) {
	    salir2("Ha ocurrido un error en la carga de la imagen", -1, 0);
	} else {
	    $permitidos = array("image/jpg", "image/jpeg", "image/png");
	    $limite_kb = 2048;
	    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
		$carpeta = "../../assets/images/empresas";
		if (!is_dir($carpeta)) {
		    mkdir($carpeta);
		}
		$formato = "." . split("/", $_FILES['imagen']['type'])[1];
		$nombreArchivo = "empresa_" . RandomString(4) . $formato;
		$ruta_old = $carpeta . "/" . $nombreArchivo;
		$subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_old);

		$conexion = dbConnect();
		$sql = "INSERT INTO empresa (nombre, cif, descripcion, web, idResponsable, tipo) "
			. " VALUES ('$nombre', '$cif', '$descripcion', '$web', $idUsuario, '$rol');";
		mysqli_query($conexion, $sql);
		$idEmpresa = mysqli_insert_id($conexion);
		$nombreArchivo = "empresa_" . $idEmpresa . $formato;
		$ruta = $carpeta . "/" . $nombreArchivo;
		$rutaImagenBD = substr($ruta, 6);
		rename($ruta_old, $ruta);
		$sql = "UPDATE empresa SET imagen='$rutaImagenBD' WHERE id=$idEmpresa;";
		$resultado = mysqli_query($conexion, $sql);
		$sql = "UPDATE usuario SET idEmpresa=$idEmpresa WHERE id=$idUsuario;";
		$resultado = mysqli_query($conexion, $sql);
		if (!$resultado) {
		    if ($subidaCorrecta) {//Si no se ha podido registrar borra la foto en caso de que se haya subido.
			unlink($ruta);
		    }
		    salir2("No se han podido guardar los cambios", -1, 0);
		} else {
		    $sql = "UPDATE usuario SET tipo='$rol' WHERE id=$idUsuario;";
		    $resultado = mysqli_query($conexion, $sql);
		    mysqli_close($conexion);
		    if ($resultado) {
			salir2("Empresa añadida correctamente", 0, "miCuenta.php");
		    } else {
			salir2("No se han podido guardar los cambios", -1, 0);
		    }
		}
	    } else {
		salir2("La imagen no tiene un formato apropiado o su tamaño es superior a 2MB", -1, 0);
	    }
	}
    }
}