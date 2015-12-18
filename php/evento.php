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






//
//
//
//        echo $evento['nombre'];
//        echo $evento['descripcion'];
////        echo $evento['ubicacion'];
//        echo date('d/m/Y', strtotime($evento['fecha']));
//        echo '<br>';
//        echo date('H:i', strtotime($evento['fecha']));
//        echo '</td>';
//        echo $evento['plazas'];
//        echo $evento['precio'];
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

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>