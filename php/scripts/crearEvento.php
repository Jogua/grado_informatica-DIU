<?php

include "../libs/myLib.php";

if (!empty($_POST['nombre']) && !empty($_POST['fecha']) && !empty($_POST['hora']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['plazas']) && !isset($_POST['imagen'])) {
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $fecha = invertirFecha($_POST['fecha']) . ' ' . $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $plazas = $_POST['plazas'];

    $conexion = dbConnect();
    $sql = "SELECT idEmpresa FROM usuario WHERE id=$idUsuario";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        $idEmpresa = $row['idEmpresa'];
    } else {
        salir2("No se han podido guardar los cambios", -1, 0);
    }

    if ($_FILES['imagen']['name']) {
        if ($_FILES['imagen']['error'] > 0) {
            salir2("Ha ocurrido un error en la carga de la imagen", -1, 0);
        } else {
            $permitidos = array("image/jpg", "image/jpeg", "image/png");
            $limite_kb = 2048;
            if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
                $carpeta = "../../assets/images/eventos";
                if (!is_dir($carpeta)) {
                    mkdir($carpeta);
                }
                $formato = "." . split("/", $_FILES['imagen']['type'])[1];
                $nombreArchivo = "evento_" . RandomString(4) . $formato;
                $ruta_old = $carpeta . "/" . $nombreArchivo;
                $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_old);

                $sql = "INSERT INTO evento (nombre, fecha, descripcion, precio, plazas, idEmpresa) "
                        . " VALUES ('$nombre', '$fecha', '$descripcion', $precio, $plazas, $idEmpresa);";
                $resultado = mysqli_query($conexion, $sql);
                if ($resultado) {
                    $idEvento = mysqli_insert_id($conexion);
                    $nombreArchivo = "evento_" . $idEvento . $formato;
                    $ruta = $carpeta . "/" . $nombreArchivo;
                    $rutaImagenBD = substr($ruta, 6);
                    rename($ruta_old, $ruta);
                    $sql = "UPDATE evento SET imagen='$rutaImagenBD' WHERE id=$idEvento;";
                    $resultado = mysqli_query($conexion, $sql);
                    if (!$resultado) {
                        if ($subidaCorrecta) {//Si no se ha podido registrar borra la foto en caso de que se haya subido.
                            unlink($ruta);
                        }                        
                        salir2("No se han podido guardar los cambios", -1, 0);
                    } else {
                        salir2("Evento creado correctamente", 0, "eventosCreados.php");
                    }
                } else {
                    salir2("No se han podido guardar los cambios", -1, 0);
                }
            } else {
                salir2("La imagen no tiene un formato apropiado o su tamaño es superior a 2MB", -1, 0);
            }
        }
    }
    mysqli_close($conexion);
}