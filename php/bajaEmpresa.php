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
	if ($tipoUsuario == 'Usuario') {
	    header('Location: miCuenta.php');
	}
	echo '<h3>Baja empresa</h3>';
	echo '<hr>';
	cargarBotonesMiCuenta($tipoUsuario);
	?>
        <script>document.getElementById("buttonBajaEmpresa").className += " active";</script>
        <div id="divBajaEmpresa">
    	<p> ¿Estas seguro de querer dar de baja a la empresa? </p>
	<a class=" btn btn-primary" id="buttonVolverBajaEmpresa" href="miCuenta.php" role="button">Volver</a>
    	<a class=" btn btn-danger" id="buttonConfirmarBajaEmpresa" href="javascript:bajaEmpresa(<?= $usuario['idEmpresa'] ?>)" role="button">Baja empresa</a>
        </div>
	<?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>