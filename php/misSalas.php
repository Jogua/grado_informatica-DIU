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
	$idEmpresa = $usuario['idEmpresa'];
	if ($tipoUsuario == 'Empresa' || $tipoUsuario == 'Organizador') {
	    echo '<h3>Mis salas</h3>';
	    echo '<hr>';
	} else {
	    mysqli_close($conn);
	    header('Location: miCuenta.php');
	}
	cargarBotonesMiCuenta($tipoUsuario);
	?>
        <script>document.getElementById("buttonSalas").className += " active";</script>
        <table class="table table-striped">
    	<thead>
    	    <tr>
    		<th class="col10">Nombre</th>
    		<th class="col10">Ubicación</th>
    		<th class="col10">Capacidad</th>
    		<th class="col10">Inicio</th>
    		<th class="col10">Fin</th>
    		<th class="col10"></th>
    	    </tr>
    	</thead>
    	<tbody>
		<?php
		$hoy = date("Y-m-d");
		$sql = "SELECT usa.id, sala.nombre, sala.ubicacion, sala.capacidad, usa.fechaInicio, usa.fechaFin "
			. " FROM sala, empresa_usa_sala AS usa "
			. " WHERE sala.id=usa.idSala AND usa.idEmpresa=$idEmpresa AND usa.fechaFin>='$hoy' "
			. " ORDER BY usa.fechaInicio;";

		$resultado = mysqli_query($conn, $sql);
		if ($resultado) {
		    while ($sala = mysqli_fetch_assoc($resultado)) {
			echo '<tr>';
			echo '<td>' . $sala['nombre'] . '</td>';
			echo '<td>' . $sala['ubicacion'] . '</td>';
			echo '<td>' . $sala['capacidad'] . '</td>';
			echo '<td>' . date('d-m-Y', strtotime($sala['fechaInicio'])) . '</td>';
			echo '<td>' . date('d-m-Y', strtotime($sala['fechaFin'])) . '</td>';

			echo '<td>';
			echo '<a class="btn btn-danger" href="javascript:cancelarReserva(' . $sala['id'] . ')">Cancelar reserva</a><br>';
			echo '</td>';
			echo '</tr>';
		    }
		} else {
		    echo '<td colspan="7">No hay salas reservadas</td>';
		}
		?>
    	</tbody>
        </table>
        <a class="btn btn-primary" href="reservarSala.php">Reservar sala</a>
	<?php
    }
    mysqli_close($conn);
    ?>
</div>

<?php include 'footer.php'; ?>