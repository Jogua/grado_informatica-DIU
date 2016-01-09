<?php
$seccion = "eventos";
include 'header.php';
include_once './libs/myLib.php';
?>

<div class="container">
    <?php
    $idEvento = $_GET['id'];

    $conn = dbConnect();

    $sql = "SELECT * FROM evento WHERE id=$idEvento;";
    $resultado = mysqli_query($conn, $sql);
    if (($evento = mysqli_fetch_assoc($resultado))) {
        
    }
    ?>
    <h3><?= $evento['nombre'] ?></h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <img class="empresaImg" src="../<?= $evento['imagen'] ?>">
        </div>
        <div class="col-md-8">

            <strong>Ubicación:</strong> 
            <?php
            $sqlUbicacion = 'SELECT sala.nombre FROM sala_aloja_evento, sala WHERE idEvento=' . $evento['id'] . ' AND idSala=sala.id;';
            $resultadoUbicacion = mysqli_query($conn, $sqlUbicacion);
            if (mysqli_num_rows($resultadoUbicacion) == 0) {
                echo 'Por determinar';
            } else {
                while ($ubicacion = mysqli_fetch_assoc($resultadoUbicacion)) {
                    echo $ubicacion['nombre'] . "<br>";
                }
            }
            ?>
            <br>
            <strong>Fecha:</strong> <?= date('d/m/Y', strtotime($evento['fecha'])); ?>
            <strong>Hora:</strong> <?= date('H:i', strtotime($evento['fecha'])); ?>
            <br>
            <strong>Descripción:</strong> <?= $evento['descripcion']; ?>
            <br>
            <strong>Plazas:</strong> <?= $evento['plazas']; ?>
            <br>
            <strong>Precio:</strong> <?= $evento['precio']; ?> €
            <br>
            <strong>Empresa:</strong> 
            <?php
            $sqlEmpresa = 'SELECT nombre FROM empresa WHERE id=' . $evento['idEmpresa'];
            $resultadoEmpresa = mysqli_query($conn, $sqlEmpresa);
            if (($empresa = mysqli_fetch_assoc($resultadoEmpresa))) {
                echo $empresa['nombre'];
            }

            if (isset($_SESSION['idUsuario'])) {
                echo '<br><br>';
                $idUsuario = $_SESSION['idUsuario'];
                $sqlBoton = "SELECT idUsuario FROM usuario_asiste_evento WHERE idUsuario=$idUsuario AND idEvento=$idEvento";
                $resultadoBoton = mysqli_query($conn, $sqlBoton);
                if (mysqli_num_rows($resultadoBoton) == 0) {
                    echo "<a class='btn btn-success' href='scripts/apuntarseEvento.php?id=$idEvento'> Apuntarse</a><br>";
                } else {
                    echo "<a class='btn btn-danger' href='scripts/desapuntarseEvento.php?id=$idEvento'> Desapuntarse</a><br>";                    
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>