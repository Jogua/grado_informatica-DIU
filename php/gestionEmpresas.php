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
	    echo '<h3>Gestión de empresas</h3>';
	    echo '<hr>';
	} else {
	    mysqli_close($conn);
	    header('Location: miCuenta.php');
	}
	cargarBotonesMiCuenta($tipoUsuario);
	?>
        <script>document.getElementById("buttonGestionEmpresas").className += " active";</script>
        <table class="table table-striped">
    	<thead>
    	    <tr>
    		<th class="col10">Nombre</th>
    		<th class="col10">CIF</th>
    		<th class="col30">Descripción</th>
    		<th class="col20">Página web</th>
    		<th class="col20">Responsable</th>
    		<th class="col10"></th>
    	    </tr>
    	</thead>
    	<tbody>
		<?php
		$hoy = date("Y-m-d H:i:s");
		$sql = "SELECT empresa.id, empresa.nombre, empresa.cif, empresa.descripcion, empresa.web, empresa.estado, usuario.correo AS responsable "
			. " FROM usuario, empresa WHERE empresa.`idResponsable`=usuario.id;";
		$resultado = mysqli_query($conn, $sql);
		if ($resultado) {
		    if (mysqli_num_rows($resultado)) {
			while ($empresa = mysqli_fetch_assoc($resultado)) {
			    echo '<tr>';
			    echo '<td>' . $empresa['nombre'] . '</td>';
			    echo '<td>' . $empresa['cif'] . '</td>';
			    echo '<td>';
			    if (strlen($empresa['descripcion']) > 130) {
				echo str_split($empresa['descripcion'], 130)[0] . '... ';
			    } else {
				echo $empresa['descripcion'];
			    };
			    echo '</td>';
			    echo '<td>' . $empresa['web'] . '</td>';
			    echo '<td>' . $empresa['responsable'] . '</td>';
			    echo '<td>';
			    if (!$empresa['estado']) {
				echo '<a class="btn btn-success botonGestionEmpresa" href="javascript:altaEmpresa(' . $empresa['id'] . ')">Activar</a><br>';
			    }
			    echo '<a class="btn btn-warning botonGestionEmpresa" href="modificarEmpresa.php?id=' . $empresa['id'] . '">Modificar</a><br>';
			    if ($empresa['estado']) {
				echo '<a class="btn btn-danger botonGestionEmpresa" href="javascript:bajaEmpresa(' . $empresa['id'] . ')">Baja</a><br>';
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