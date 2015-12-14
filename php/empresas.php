<?php $seccion="empresas"; include 'header.php';?>

<div class="container">
  <h3>Nuestras empresas</h3>

  <?php
  include 'dbConnect.php';
  $conn = dbConnect();

  $sql = "SELECT * FROM empresa;";
  $resultado = mysqli_query($conn, $sql);
  $i = 0;

  while($empresa = mysqli_fetch_assoc($resultado)){
    if($i%4 == 0){
      //$clase = "izquierda";
      echo "<hr>";
      echo '<div class="row">';
    }else{
      //$clase = "derecha";
    }
    echo '<div class="col-lg-3 col-md-3">';
    echo '<img class="empresaImg" src="../' . $empresa['imagen'] . '">';
    echo '<h4>';
    echo $empresa['nombre'];
    echo '</h4>';
    echo '<p>';
    echo $empresa['descripcion'];
    echo '</p>';
    echo '<p><a href="http://' . $empresa['web'] . '">';
    echo $empresa['web'];
    echo '</a></p>';
    echo '</div>';
    $i = $i+1;
    if($i%4 == 0){
      echo "</div>"; //div row
    }
  }
  if($i%4 != 0){//por si no hay un numero multimplo de $numEmpresasFila
    echo "</div>"; //div row
  }

  ?>
</div>
<?php include 'footer.php';?>
