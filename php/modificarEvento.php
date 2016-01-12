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

if (isset($_GET['id'])) {
    $idEvento = $_GET['id'];
} else { //Si no tiene la sesión iniciada
    header('Location: miCuenta.php');
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
	echo '<h3>Crear evento</h3>';
	echo '<hr>';
	cargarBotonesMiCuenta($tipoUsuario);

	$sql = "SELECT evento.*, sala.id AS idSala, sala.nombre AS nombreSala, sala.capacidad "
		. " FROM evento, sala, sala_aloja_evento AS aloja "
		. " WHERE evento.id=$idEvento AND sala.id=aloja.idSala AND evento.id=aloja.idEvento;";
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
	    $evento = mysqli_fetch_assoc($resultado);
	    echo '<h4 class="nombreSala">' . $evento['nombre'] . '</h4>';
	    echo '<hr>';
	    ?>
	    <form class="form-signin" method="POST" id="formularioModificarEvento" action="scripts/modificarEvento.php" data-toggle="validator" enctype="multipart/form-data">
		<input type="hidden" id="idEvento" name="idEvento" value="<?= $idEvento ?>"/>
		<div class="form-group has-feedback">
		    <label>Nombre</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $evento['nombre'] ?>" placeholder="Taller de acupuntura" required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
		    <label>Fecha</label>
		    <div class="input-group date" data-provide="datepicker">
			<input type="text" class="form-control" id="fecha" name="fecha" value="<?= date('d-m-Y', strtotime($evento['fecha'])); ?>" placeholder="dd-mm-aaaa" onchange="filtrarSalasParaEvento()" required>
			<div class="input-group-addon">
			    <span class="glyphicon glyphicon-th"></span>
			</div>
		    </div>
		</div>
		<div class="form-group has-feedback">
		    <label>Hora</label>
		    <input type="text" id="hora" name="hora" class="form-control" value="<?= date('H:i', strtotime($evento['fecha'])); ?>" placeholder="10:00" required>
		</div>
		<div class="form-group has-feedback">
		    <label>Descripción</label>
		    <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required><?= $evento['descripcion'] ?></textarea>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>

		<div class="form-group has-feedback">
		    <label>Precio</label>
		    <input type="number" id="precio" name="precio" min="1" class="form-control" value="<?= $evento['precio'] ?>" placeholder="50"  required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>

		<div class="form-group has-feedback">
		    <label>Plazas</label>
		    <input type="number" id="plazas" name="plazas" min="1" class="form-control" value="<?= $evento['plazas'] ?>" placeholder="10" onchange="filtrarSalasParaEvento()" required>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>

		<div class="form-group">
		    <label>Imagen</label><br>
		    <div class="row">
			<div class="col-md-4 vertical-center">
			    <img id="salaImgModificar" class="empresaImg" src="../../<?= $evento['imagen'] ?>" alt="Imagen sala"/>
			</div>
			<div class="col-md-6 vertical-center">
			    <p>Cambiar imagen</p>
			    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
			</div>
		    </div>
		</div>
		<input type="hidden" id="idSalaDefault" name="idSalaDefault" value="<?= $evento['idSala'] ?>"/>
		<div class="form-group has-feedback">
		    <label>Sala</label><br>
		    <div id="salasReservarEvento">
			<select class="form-control" id="selectSalas" name="selectSalas" required>
			    <option value="<?= $evento['idSala'] ?>"><?= $evento['nombreSala'] ?> (<?= $evento['capacidad'] ?> plazas)</option>
			</select>
		    </div>
		    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		    <div class="help-block with-errors"></div>
		</div>
		<div class="form-group">
		    <button type="submit" class="btn btn-primary derecha">Guardar cambios</button>
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