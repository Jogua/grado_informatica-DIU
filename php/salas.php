<?php
$seccion = "salas";
include 'header.php';
?>

<div class="container">
    <h3>Nuestras salas</h3>
    <?php
    include 'libs/myLib.php';
    $conn = dbConnect();

    $sql = "SELECT * FROM sala;";
    $resultado = mysqli_query($conn, $sql);
    $i = 0;
    while ($sala = mysqli_fetch_assoc($resultado)) {
        echo "<hr>";
        if ($i % 2 == 0) {
            $clase = "izquierda";
        } else {
            $clase = "derecha";
        }
        echo '<div class="contenidoSala row">';
        echo '<img class="salaImg ' . $clase . '" src="../' . $sala['imagen'] . '">';

        echo '<div class="col-lg-9 col-md-9">';
        echo '<h4>';
        echo $sala['nombre'];
        echo '</h4>';
        echo '<p>';
        echo $sala['ubicacion'];
        echo '</p>';
        $descripcion = explode("\n", $sala['descripcion']);
        foreach ($descripcion as $str) {
            echo "<p>" . $str . "</p>";
        }
        echo '</div>';
        echo '</div>';
        $i = $i + 1;
    }
    ?>
</div>

<?php include 'footer.php'; ?>