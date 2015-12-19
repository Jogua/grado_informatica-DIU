<?php
$seccion = "";
include 'header.php';
include_once './libs/myLib.php';

if (!isset($_SESSION['idUsuario'])) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
} else {
    header('Location: index.php');
}
?>

<div class="container">
    <h3>Mi cuenta</h3>
    <hr>
    <?php
    $conn = dbConnect();
    $sql = "SELECT * FROM usuario WHERE id=$idUsuario";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
	$usuario = mysqli_fetch_assoc($resultado);
	cargarBotonesMiCuenta($usuario['tipo']);
    }
    ?>
</div>

<?php include 'footer.php'; ?>