<?php

include_once '../libs/myLib.php';

echo '<select class="form-control" id="selectSalas" name="selectSalas" required>';
if (!empty($_POST['fecha']) && !empty($_POST['plazas'])) {
    $fecha = invertirFecha($_POST['fecha']);
    $plazas = $_POST['plazas'];
    if (isset($_POST['idSalaDefault'])) {
	$idSala = $_POST['idSalaDefault'];
    } else {
	$idSala = -1;
    }

    $conn = dbConnect();
    $sqlSalas = "SELECT * FROM sala WHERE sala.estado=1 AND sala.capacidad>=$plazas AND sala.id NOT IN ("
	    . " SELECT idSala FROM empresa_usa_sala "
	    . " WHERE (fechaInicio>='$fecha' AND fechaInicio<'$fecha') OR (fechaFin>'$fecha' AND fechaInicio<='$fecha')"
	    . ") ORDER BY capacidad;";
    $resultado = mysqli_query($conn, $sqlSalas);
    if ($resultado) {
	while ($sala = mysqli_fetch_assoc($resultado)) {
	    if ($sala['id'] == $idSala) {
		echo '<option selected value="' . $sala['id'] . '">' . $sala['nombre'] . ' (' . $sala['capacidad'] . ' plazas)</option>';
	    } else {
		echo '<option value="' . $sala['id'] . '">' . $sala['nombre'] . ' (' . $sala['capacidad'] . ' plazas)</option>';
	    }
	}
    }
}
echo '</select>';
/*
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
}*/