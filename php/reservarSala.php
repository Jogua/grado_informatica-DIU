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
	echo '<h4 class="nombreSala">Reservar sala</h4>';
	echo '<hr>';
	?>
        <div class="row">
    	<div class="col-lg-6 col-md-6 col-sm-6">
    	    <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?= $idEmpresa ?>"/>
    	    <div class="form-group">
    		<label>Nombre</label>
    		<input type="text" onkeyup="filtroReservarSala();" class="form-control" id="nombreSala" name="nombreSala" placeholder="Salón">
    	    </div>
    	    <div class="form-group">
    		<label>Capacidad Mínima</label>
    		<input type="number" id="capacidadSala" onchange="filtroReservarSala();" name="capacidadSala" value="" min="1" class="form-control" placeholder="50">
    	    </div>
    	</div>
    	<div class="col-lg-6 col-md-6 col-sm-6">
    	    <div class="form-group">
    		<label>Fecha de inicio</label>
    		<div class="input-group date" data-provide="datepicker">
    		    <input type="text" class="form-control" id="fechaInicioSala" name="fechaInicioSala" value="<?= date("d-m-Y") ?>" onchange="filtroReservarSala();" required>
    		    <div class="input-group-addon">
    			<span class="glyphicon glyphicon-th"></span>
    		    </div>
    		</div>
    	    </div>
    	    <div class="form-group">
    		<label>Fecha de fin</label>
    		<div class="input-group date" data-provide="datepicker">
    		    <input type="text" class="form-control" id="fechaFinSala" name="fechaFinSala" value="<?= date("d-m-Y") ?>" onchange="filtroReservarSala();" required>
    		    <div class="input-group-addon">
    			<span class="glyphicon glyphicon-th"></span>
    		    </div>
    		</div>
    	    </div>
    	</div>
        </div>
        <div id="salas">
    	<script>
    	    window.onload = function () {
    		filtroReservarSala();
    	    };
    	</script>
        </div>
	<?php
    } else {
	mysqli_close($conn);
    }
    ?>
</div>

<?php include 'footer.php'; ?>