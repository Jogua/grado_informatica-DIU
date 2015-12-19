<?php
$seccion = "";
include 'header.php';
include_once './libs/myLib.php';

if (!isset($_SESSION['idUsuario'])) {
    session_start();
}

if (isset($_SESSION['idUsuario']) && isset($_GET['id'])) {
    $idUsuario = $_SESSION['idUsuario'];
    $idSala = $_GET['id'];
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
	    $sql = "SELECT * FROM sala WHERE id=$idSala;";
	    $resultado = mysqli_query($conn, $sql);
	    if ($resultado) {
		$sala = mysqli_fetch_assoc($resultado);
		echo '<h3>Modificación de sala</h3>';
		echo '<hr>';
	    }
	    mysqli_close($conn);
	}
	cargarBotonesMiCuenta($tipoUsuario);
	echo '<h4 class="nombreSala">' . $sala['nombre'] . '</h4>';
	echo '<hr>';
	?>
        <script>document.getElementById("salasButon").className += " active";</script>
        <form class="form-signin" method="POST" id="formularioModificarSala"  action="scripts/modificarSala.php" data-toggle="validator" enctype="multipart/form-data">
    	<input type="hidden" id="idSala" name="idSala" value="<?= $idSala ?>"/>
    	<div class="form-group has-feedback">
    	    <label>Nombre</label>
    	    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Salón" value="<?= $sala['nombre'] ?>" required>
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Descripción</label>
    	    <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required><?= $sala['descripcion'] ?></textarea>
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Ubicación</label>
    	    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Edificio principal" value="<?= $sala['ubicacion'] ?>" required>
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Capacidad</label>
    	    <input type="number" id="capacidad" name="capacidad" value="<?= $sala['capacidad'] ?>" min="1" class="form-control" placeholder="50"  required>
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group">
    	    <label>Imagen</label><br>
    	    <div class="row">
    		<div class="col-md-4 vertical-center">
    		    <img id="salaImgModificar" class="salaImg" src="../../<?= $sala['imagen'] ?>" alt="Imagen sala"/>
    		</div>
    		<div class="col-md-6 vertical-center">
    		    <p>Cambiar imagen</p>
    		    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
    		</div>
    	    </div>
    	</div>
    	<div class="form-group">
    	    <button type="submit" class="btn btn-primary derecha">Guardar cambios</button>
    	    <a href="gestionSalas.php" class="btn btn-danger izquierda">Cancelar</a>
    	</div>
        </form>
	<?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>