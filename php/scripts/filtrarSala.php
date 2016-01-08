<?php
include_once '../libs/myLib.php';
$conn = dbConnect();
$sqlSalas = "SELECT * FROM sala WHERE sala.estado=1 AND ";
$otro = false;
if (!empty($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $sqlSalas .= "sala.nombre like '%$nombre%' ";
    $otro = true;
}
if (!empty($_POST['capacidad'])) {
    if ($otro) {
	$sqlSalas .= "AND ";
    }
    $capacidad = $_POST['capacidad'];
    $sqlSalas .= "sala.capacidad>=$capacidad ";
    $otro = true;
}
$faltaFecha = false;
if (!empty($_POST['fechaInicio']) && !empty($_POST['fechaFin'])) {
    if ($otro) {
	$sqlSalas .= "AND ";
    }
    $fechaInicio = invertirFecha($_POST['fechaInicio']);
    $fechaFin = invertirFecha($_POST['fechaFin']);
    $sqlSalas .= " sala.id NOT IN (SELECT idSala FROM empresa_usa_sala WHERE (fechaInicio>='$fechaInicio' AND fechaInicio<'$fechaFin') OR (fechaFin>'$fechaInicio' AND fechaInicio<='$fechaFin'));";
} else {
    $faltaFecha = true;
}

if ($faltaFecha) {
    salir2("Falta fecha", -1, 0);
} else {
    ?>
    <table class = "table">
        <thead>
    	<tr>
    	    <th class="col10">Nombre</th>
    	    <th class="col40">Descripción</th>
    	    <th class="col10">Ubicación</th>
    	    <th class="col10">Capacidad</th>
    	    <th class="col10"></th>
    	</tr>
        </thead>
        <tbody>
	    <?php
	    $resultado = mysqli_query($conn, $sqlSalas);
	    if ($resultado) {
		if (mysqli_num_rows($resultado) == 0) {
		    echo '<tr class="filaEvento">';
		    echo '<td colspan="7">No se han encontrado salas</td>';
		    echo '</tr>';
		} else {
		    while ($sala = mysqli_fetch_assoc($resultado)) {
			?>
			<tr class="filaEvento" onclick="window.location = 'evento.php?id=<?= $evento['id'] ?>'">
			    <td><?= $sala['nombre'] ?></td>
			    <td><?php
				if (strlen($sala['descripcion']) > 130) {
				    echo str_split($sala['descripcion'], 130)[0] . '... ';
				} else {
				    echo $sala['descripcion'];
				}
				?></td>
			    <td><?= $sala['ubicacion'] ?></td>
			    <td><?= $sala['capacidad'] ?></td>
			    <td>
				<a class="btn btn-primary" href="javascript:reservarSala(<?= $sala['id'] ?>)">Reservar</a><br>
			    </td>
			</tr>
			<?php
		    }
		}
	    }
	    mysqli_close($conn);
	    ?>
        </tbody>
    </table>
    <?php
}