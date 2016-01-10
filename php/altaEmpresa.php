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

        echo '<h3>Alta de empresa</h3>';
        echo '<hr>';

        mysqli_close($conn);
        cargarBotonesMiCuenta($tipoUsuario);
        echo '<h4 class="nombreSala">Datos de la empresa</h4>';
        echo '<hr>';
        ?>
        <script>document.getElementById("buttonAltaEmpresa").className += " active";</script>
        <form class="form-signin" method="POST" action='scripts/altaEmpresa.php' id="formularioAltaEmpresa" data-toggle="validator" enctype="multipart/form-data">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $idUsuario ?>"/>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" autofocus required>
            </div>
            <div class="form-group">
                <label>CIF</label>
                <input type="text" class="form-control" id="cif" name="cif" required>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control text-justify" id="descripcion" name="descripcion" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label>Web</label>
                <input type="text" class="form-control" id="web" name="web" required>
            </div>
            <div class="form-group">
                <label>Imagen</label><br>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <div class="form-group">
                <label>¿Sólo organiza eventos?
                <input type="checkbox" class="form-control" id="checkbox" name="checkbox"></label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary izquierda">Dar de alta</button>
            </div>
        </form>
        <?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>