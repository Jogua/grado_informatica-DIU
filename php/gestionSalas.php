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
	if ($tipoUsuario == 'Administrador' || $tipoUsuario == 'Empresa') {
	    echo '<h3>Gestión de salas</h3>';
	    echo '<hr>';
	} else {
	    mysqli_close($conn);
	    header('Location: miCuenta.php');
	}
	cargarBotonesMiCuenta($tipoUsuario);
	?>
        <script>document.getElementById("salasButon").className += " active";</script>
        <table class="table table-striped">
    	<thead>
    	    <tr>
    		<th class="col10">Nombre</th>
    		<th class="col60">Descripción</th>
    		<th class="col10">Ubicación</th>
    		<th class="col10">Capacidad</th>
    		<th class="col10"></th>
    	    </tr>
    	</thead>
    	<tbody>
		<?php
		if ($tipoUsuario == 'Administrador') {
		    $sql = "SELECT * FROM sala;";
		} else {
		    $sql = "SELECT * FROM sala WHERE estado=1;";
		}
		$resultado = mysqli_query($conn, $sql);
		while ($sala = mysqli_fetch_assoc($resultado)) {
		    echo '<tr>';
		    echo '<td>' . $sala['nombre'] . '</td>';
		    $descripcion = explode("\n", $sala['descripcion']);
		    echo '<td>';
		    foreach ($descripcion as $str) {
			echo '<p class="text-justify">' . $str . '</p>';
		    }
		    echo '</td>';
		    echo '<td>' . $sala['ubicacion'] . '</td>';
		    echo '<td>' . $sala['capacidad'] . '</td>';
		    if ($tipoUsuario == 'Administrador') {
			echo '<td>';
			if (!$sala['estado']) {
			    echo '<a class="btn btn-success botonSala" href="javascript:altaSala(' . $sala['id'] . ')">Alta</a><br>';
			}
			echo '<a class="btn btn-warning botonSala" href="modificarSala.php?id=' . $sala['id'] . '" readonly>Modificar</a><br>';
			if ($sala['estado']) {
			    echo '<a class="btn btn-danger botonSala" href="javascript:bajaSala(' . $sala['id'] . ')">Baja</a><br>';
			}
			echo '</td>';
		    } else {
			echo '<td>';
			echo '<a class="btn btn-primary botonSala" href="javascript:altaSala(' . $sala['id'] . ')">Reservar</a><br>';
			echo '<a class="btn btn-danger botonSala" href="modificarSala.php?id=' . $sala['id'] . '">Cancelar</a><br>';
			echo '</td>';
		    }
		    echo '</tr>';
		}
		?>
    	</tbody>
        </table>
	<?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>