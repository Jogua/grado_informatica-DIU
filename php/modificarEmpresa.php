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
	    if (isset($_GET['id'])) {
		$idEmpresa = $_GET['id'];
	    } else {
		header('Location: gestionEmpresas.php');
	    }
	} else {
	    $idEmpresa = $usuario['idEmpresa'];
	}
	echo '<h3>Modificar datos de mi empresa</h3>';
	echo '<hr>';
	cargarBotonesMiCuenta($tipoUsuario);
	echo '<h4 class="nombreSala">Datos de la empresa</h4>';
	echo '<hr>';
	$sql = "SELECT * FROM empresa WHERE id=$idEmpresa";
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
	    $empresa = mysqli_fetch_assoc($resultado);
	    ?>
	    <script>document.getElementById("buttonAltaEmpresa").className += " active";</script>
	    <form class="form-signin" method="POST" action='scripts/modificarEmpresa.php' id="formularioModificarEmpresa" data-toggle="validator" enctype="multipart/form-data">
		<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?= $idEmpresa ?>"/>
		<div class="form-group">
		    <label>Nombre</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $empresa['nombre'] ?>" autofocus required>
		</div>
		<div class="form-group">
		    <label>CIF</label>
		    <input type="text" class="form-control" id="cif" name="cif" value="<?= $empresa['cif'] ?>" required>
		</div>
		<div class="form-group">
		    <label>Descripción</label>
		    <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required><?= $empresa['descripcion'] ?></textarea>
		</div>
		<div class="form-group">
		    <label>Web</label>
		    <input type="text" class="form-control" id="web" name="web" value="<?= $empresa['web'] ?>" required>
		</div>

		<div class="form-group">
		    <label>Imagen</label><br>
		    <div class="row">
			<div class="col-md-4 vertical-center">
			    <img id="salaImgModificar" class="empresaImg" src="../<?= $empresa['imagen'] ?>" alt="Imagen sala"/>
			</div>
			<div class="col-md-6 vertical-center">
			    <p>Cambiar imagen</p>
			    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
			</div>
		    </div>
		</div>

		<div class="form-group">
		    <button type="submit" class="btn btn-primary derecha">Guardar cambios</button>
		    <a href="miCuenta.php" class="btn btn-danger izquierda">Cancelar</a>   
		</div>
	    </form>
	    <?php
	}
    }
    mysqli_close($conn);
    ?>
</div>

<?php include 'footer.php'; ?>