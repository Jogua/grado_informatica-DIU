<?php
$seccion = "contacto";
include 'header.php';
?>

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h3>Contacta con nosotros</h3>
            <hr>
            <form id="formularioContacto" action="scripts/contacto.php" method="post">
                <div class="form-group">
                    <label for="labelNombre">Nombre:</label>
                    <input type="text" class="form-control" name="inputNombre" required>
                </div>
                <div class="form-group">
                    <label for="labelCorreo">Correo electronico:</label>
                    <input type="email" class="form-control" name="inputCorreo" required>
                </div>
                <div class="form-group">
                    <label for="labelConsulta">Consulta:</label>
                    <textarea class="form-control" rows="3" name="inputConsulta" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Ven a visitarnos</h3>
            <hr>
            <iframe id="floatMapa" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3178.1826164221484!2d-3.624947646207729!3d37.19589171910666!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x4dbbca09efdcad08!2sE.T.S.+de+Ingenier%C3%ADas+Inform%C3%A1tica+y+de+Telecomunicaci%C3%B3n!5e0!3m2!1ses!2ses!4v1426528921342" width="370" height="300" frameborder="0"></iframe>  
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>