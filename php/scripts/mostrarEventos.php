<?php
include_once '../libs/myLib.php';
$conn = dbConnect();
$nombre_filtro = $_POST['search'];

$todosEventos = "SELECT * FROM evento WHERE evento.nombre like '%$nombre_filtro%' ORDER BY fecha;";

$resultado = mysqli_query($conn, $todosEventos);
?>
<table class = "table">
    <tr>
        <th id="colNombre">Nombre</th>
        <th id="colDescripcion">Descripción</th>
        <th id="colUbicacion">Ubicación</th>
        <th id="colFecha">fecha</th>
        <th id="colPlazas">Plazas</th>
        <th id="colPrecio">Precio</th>
        <th id="colBotones"></th>
    </tr>
    <?php
    while ($evento = mysqli_fetch_assoc($resultado)) {
        ?>
        <tr class="filaEvento" onclick="window.location = '#<?= $evento['id'] ?>'">
            <td><?= $evento['nombre'] ?></td>
            <td><?php
                if (strlen($evento['descripcion']) > 130) {
                    echo str_split($evento['descripcion'], 130)[0] . '... ' . '<a href="#' . $evento['id'] . '">Más</a>';
                } else {
                    echo $evento['descripcion'];
                }
                ?></td>
            <td><?php
                $sqlUbicacion = 'SELECT sala.nombre FROM sala_aloja_evento, sala WHERE idEvento=' . $evento['id'] . ' AND idSala=sala.id;';
                $resultadoUbicacion = mysqli_query($conn, $sqlUbicacion);
                if (mysqli_num_rows($resultadoUbicacion) == 0) {
                    echo 'Por determinar';
                } else {
                    while ($ubicacion = mysqli_fetch_assoc($resultadoUbicacion)) {
                        echo $ubicacion['nombre'] . "<br>";
                    }
                }
                ?></td>
            <td><?= date('d/m/Y', strtotime($evento['fecha'])) ?><br><?= date('H:i', strtotime($evento['fecha'])) ?></td>
            <td><?= $evento['plazas'] ?></td>
            <td><?= $evento['precio'] ?> €</td>
            <td>
                <a class="btn btn-primary" href="#<?= $evento['id'] ?>">Inscribete</a><br>
                <a class="btn btn-default margen" href="#<?= $evento['id'] ?>">Más</a>
            </td>
        </tr>
        <?php
    }
    mysqli_close($conn);
    ?>
</table>
