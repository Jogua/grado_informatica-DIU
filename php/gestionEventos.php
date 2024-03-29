<?php
$seccion = "";
include 'header.php';
include_once './libs/myLib.php';

if (!isset($_SESSION['idUsuario'])) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
} else { //Si no tiene la sesión iniciada
    header('Location: index.php');
}
?>

<div class="container">
    <?php
    $conn = dbConnect();
    $sql = "SELECT * FROM usuario WHERE id=$idUsuario";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
	$usuario = mysqli_fetch_assoc($resultado);
	$tipoUsuario = $usuario['tipo'];
	if ($tipoUsuario == 'Administrador') {
	    echo '<h3>Gestión de eventos</h3>';
	    echo '<hr>';
	} else {
	    mysqli_close($conn);
	    header('Location: miCuenta.php');
	}
	cargarBotonesMiCuenta($tipoUsuario);
	?>
        <script>document.getElementById("buttonGestionEventos").className += " active";</script>
        <table class="table table-striped">
    	<thead>
    	    <tr>
    		<th class="col10">Nombre</th>
    		<th class="col10">Responsable</th>
    		<th class="col10">Ubicación</th>
    		<th class="col10">Fecha</th>
    		<th class="col10">Precio</th>
    		<th class="col10"></th>
    	    </tr>
    	</thead>
    	<tbody>
		<?php
		$hoy = date("Y-m-d H:i:s");
		$sql = "SELECT evento.id, evento.nombre, evento.fecha, evento.precio, empresa.nombre AS responsable, evento.estado FROM evento, empresa "
			. " WHERE evento.`idEmpresa`=empresa.id AND evento.fecha>='$hoy' "
			. " ORDER BY evento.fecha;";
		$resultado = mysqli_query($conn, $sql);
		if ($resultado) {
		    if (mysqli_num_rows($resultado)) {
			while ($evento = mysqli_fetch_assoc($resultado)) {
			    echo '<tr>';
			    echo '<td>' . $evento['nombre'] . '</td>';
			    echo '<td>' . $evento['responsable'] . '</td>';
			    echo '<td>';
			    $sqlUbicacion = 'SELECT sala.nombre FROM sala_aloja_evento, sala WHERE idEvento=' . $evento['id'] . ' AND idSala=sala.id;';
			    $resultadoUbicacion = mysqli_query($conn, $sqlUbicacion);
			    if (mysqli_num_rows($resultadoUbicacion) == 0) {
				echo 'Por determinar';
			    } else {
				while ($ubicacion = mysqli_fetch_assoc($resultadoUbicacion)) {
				    echo $ubicacion['nombre'] . "<br>";
				}
			    }
			    echo '</td>';
			    echo '<td>' . date('d-m-Y', strtotime($evento['fecha'])) . '<br>' . date('H:i', strtotime($evento['fecha'])) . '</td>';
			    echo '<td>' . $evento['precio'] . ' €</td>';

			    echo '<td>';
			    if (!$evento['estado']) {
				echo '<a class="btn btn-success botonSala" href="javascript:altaEvento(' . $evento['id'] . ')">Activar</a>';
			    }
			    echo '<a class="btn btn-warning botonSala" href="modificarEvento.php?id=' . $evento['id'] . '">Modificar</a>';
			    if ($evento['estado']) {
				echo '<a class="btn btn-danger botonSala" href="javascript:cancelarEvento(' . $evento['id'] . ')">Cancelar</a>';
			    }
			    echo '</td>';
			    echo '</tr>';
			}
		    } else {
			echo '<td colspan="5">No existen eventos para gestionar</td>';
		    }
		}
		?>
    	</tbody>
        </table>
	<?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>