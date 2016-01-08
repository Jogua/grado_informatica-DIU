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
	if ($tipoUsuario != 'Administrador') {
	    header('Location: miCuenta.php');
	} else {
	    echo '<h3>Gestión de salas</h3>';
	    echo '<hr>';
	    cargarBotonesMiCuenta($tipoUsuario);
	    echo '<h4 class="nombreSala">Añadir sala</h4>';
	    echo '<hr>';
	    ?>
	    <form class="form-signin" method="POST" id="formularioAnadirSala"  action="scripts/anadirSala.php" data-toggle="validator" enctype="multipart/form-data">
		<div class="form-group has-feedback">
		    <label>Nombre</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Salón" required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
		    <label>Descripción</label>
		    <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required></textarea>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
		    <label>Ubicación</label>
		    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Edificio principal" required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
		    <label>Capacidad</label>
		    <input type="number" id="capacidad" name="capacidad" min="1" class="form-control" placeholder="50"  required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
		    <label>Imagen</label><br>
		    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required="">
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group">
		    <button type="submit" class="btn btn-primary derecha">Añadir</button>
		    <a href="gestionSalas.php" class="btn btn-danger izquierda">Cancelar</a>
		</div>
	    </form>
	    <?php
	}
    }
    mysqli_close($conn);
    ?>
</div>

<?php include 'footer.php'; ?>