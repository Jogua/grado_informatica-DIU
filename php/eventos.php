<?php
$seccion = "eventos";
include 'header.php';
?>

<div class="container">

    <h3>Eventos</h3>
    <hr/>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
        <input type="text" id="busqueda" name="busqueda" onkeyup="MostrarConsultaEventos();" class="form-control" placeholder="Buscar...">
    </div>

    <div id="todosEventos">
        <table class="table">
            <thead>
                <tr>
                    <th id="colNombre">Nombre</th>
                    <th id="colDescripcion">Descripción</th>
                    <th id="colUbicacion">Ubicación</th>
                    <th id="colFecha">fecha</th>
                    <th id="colPlazas">Plazas</th>
                    <th id="colPrecio">Precio</th>
                    <th id="colBotones"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'libs/myLib.php';
                $conn = dbConnect();

                $sql = 'SELECT * FROM evento ORDER BY fecha;';
                $resultado = mysqli_query($conn, $sql);

                while ($evento = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr class="filaEvento" onclick="window.location = '#<?= $evento['id'] ?>'">
                        <td><?= $evento['nombre'] ?></td>
                        <td><?php
                            if (strlen($evento['descripcion']) > 130) {
                                echo str_split($evento['descripcion'], 130)[0] . '... ' . '<a href="#' . $evento['id'] . '">Continuar</a>';
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
                            <!--<a class="btn btn-default margen" href="#<?= $evento['id'] ?>">Más</a>-->
                        </td>
                    </tr>
                    <?php
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
