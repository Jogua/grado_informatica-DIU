<?php
$seccion = "empresas";
include 'header.php';
include_once './libs/myLib.php';

if (isset($_GET['id'])) {
    $idEmpresa = $_GET['id'];
} else {
    header("Location: empresas.php");
}
?>



<div class="container">
    <?php
    $conn = dbConnect();

    $sql = "SELECT * FROM empresa WHERE id=$idEmpresa;";
    $resultado = mysqli_query($conn, $sql);
    if (($empresa = mysqli_fetch_assoc($resultado))) {
	
    }
    ?>
    <h3><?= $empresa['nombre'] ?></h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <img class="empresaImg" src="../<?= $empresa['imagen'] ?>">
        </div>
        <div class="col-md-8">

            <p><strong>CIF: </strong> <?= $empresa['cif'] ?></p>
	    <p><strong>Página web: </strong>
		<a target="_blank" href="http://<?= $empresa['web'] ?>"> <?= $empresa['web'] ?></a></p>
	    <p><strong>Descripción:</strong> </p>
	    <p><?= $empresa['descripcion']; ?></p>
	    <a href="empresas.php" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>