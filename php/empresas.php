<?php
$seccion = "empresas";
include 'header.php';
?>

<div class="container">
    <h3>Nuestras empresas</h3>

    <?php
    include 'libs/myLib.php';
    $conn = dbConnect();

    $sql = "SELECT * FROM empresa;";
    $resultado = mysqli_query($conn, $sql);
    $i = 0;

    while ($empresa = mysqli_fetch_assoc($resultado)) {
	if ($i % 4 == 0) {
	    echo "<hr>";
	    echo '<div class="row">';
	}
	echo '<div class="col-lg-3 col-md-3">';
	echo '<img class="empresaImg" src="../' . $empresa['imagen'] . '">';
	echo '<h4>';
	echo $empresa['nombre'];
	echo '</h4>';
	echo '<p>';
	if (strlen($empresa['descripcion']) > 130) {
	    echo str_split($empresa['descripcion'], 130)[0] . '...';
	} else {
	    echo $empresa['descripcion'];
	}
	echo '</p>';
	echo '<p><a target="_blank" href="http://' . $empresa['web'] . '">';
	echo $empresa['web'];
	echo '</a></p>';
	echo '<a class="btn btn-default" href="empresa.php?id=' . $empresa['id'] . '">Ver más</a>';
	echo '</div>';
	$i = $i + 1;
	if ($i % 4 == 0) {
	    echo "</div>"; //div row
	}
    }
    if ($i % 4 != 0) {//por si no hay un numero multimplo de $numEmpresasFila
	echo "</div>"; //div row
    }
    ?>
</div>
<?php include 'footer.php'; ?>
