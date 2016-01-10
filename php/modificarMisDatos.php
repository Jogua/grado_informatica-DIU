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

	echo '<h3>Modificar mis datos</h3>';
	echo '<hr>';

	mysqli_close($conn);
	cargarBotonesMiCuenta($tipoUsuario);
	echo '<h4 class="nombreSala">Datos de usuario</h4>';
	echo '<hr>';
	?>
        <script>document.getElementById("buttonModificarMisDatos").className += " active";</script>
        <form class="form-signin" method="POST" action='javascript:modificarMisDatos(this)' id="formularioModificarDatosUsuario" data-toggle="validator">
    	<input type="hidden" id="idUsuario" name="idUsuario" value="<?= $idUsuario ?>"/>
    	<div class="form-group">
    	    <label>Nombre</label>
    	    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" autofocus>
    	</div>
    	<div class="form-group">
    	    <label>Apellidos</label>
    	    <input type="text" class="form-control" id="apellidos" name="apellidos" value='<?= $usuario['apellidos'] ?>'>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Correo electrónico</label>
    	    <input type="email" pattern="^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$" class="form-control" id="correo" name="correo" value='<?= $usuario['correo'] ?>' required>
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Contraseña</label>
    	    <input type="password" id="pass" name="pass" data-minlength="6" data-minlength-error="Mínimo 6 caracteres" class="form-control">
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group has-feedback">
    	    <label>Repetir contraseña</label>
    	    <input type="password" class="form-control" id="pass2" name="pass2" data-match="#pass" data-match-error="Las contraseñas no coinciden">
    	    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	    <div class="help-block with-errors"></div>
    	</div>
    	<div class="form-group">
    	    <label>Teléfono</label>
    	    <input type="tel" class="form-control" id="telefono" name="telefono" value='<?= $usuario['telefono'] ?>'>
    	</div>

    	<div class="form-group">
    	    <button type="submit" class="btn btn-primary izquierda">Guardar cambios</button>

    	</div>
        </form>
	<?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>