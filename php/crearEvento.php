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

        echo '<h3>Crear evento</h3>';
        echo '<hr>';
        cargarBotonesMiCuenta($tipoUsuario);
        echo '<h4 class="nombreSala">Datos del evento</h4>';
        echo '<hr>';
        ?>
    <form class="form-signin" method="POST" id="formularioCrearEvento" action="scripts/crearEvento.php" onsubmit="validarSala(this)" data-toggle="validator" enctype="multipart/form-data">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $idUsuario ?>"/>
            <div class="form-group has-feedback">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Taller de acupuntura" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <label>Fecha</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="dd-mm-aaaa" onchange="filtrarSalasParaEvento()" required>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label>Hora</label>
                <input type="text" id="hora" name="hora" class="form-control" placeholder="10:00" required>
            </div>
            <div class="form-group has-feedback">
                <label>Descripción</label>
                <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
                <label>Precio</label>
                <input type="number" id="precio" name="precio" min="1" class="form-control" placeholder="50"  required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
                <label>Plazas</label>
                <input type="number" id="plazas" name="plazas" min="1" class="form-control" placeholder="10" onchange="filtrarSalasParaEvento()" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
                <label>Imagen</label><br>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <label>Sala</label><br>
		<div id="salasReservarEvento">
		    <select class="form-control" id="selectSalas" name="selectSalas" required>
		    </select>
		</div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary izquierda">Crear</button>                
            </div>
        </form>
        <?php
    }

    mysqli_close($conn);
    ?>
</div>

<?php include 'footer.php'; ?>