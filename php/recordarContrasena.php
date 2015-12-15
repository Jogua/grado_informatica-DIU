<?php
$seccion = "";
include 'header.php';
?>

<div class="container">
    <h3>¿Has olvidado tu contraseña?</h3>
    <hr>
    <form class="form-horizontal" id="formularioRecordarContraseña" name="formularioRecordarContraseña" method="POST" action="" data-toggle="validator" role="form">
        <div class="form-group has-feedback">
            <label>Email</label>
            <input type="email" pattern="^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$" class="form-control" id="correo" name="correo" placeholder="Email" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary inicioSesion derecha">Recordar Contraseña</button>
            <small class="izquierda">¿No estás registrado? <a href="registro.php">Regístrate</a></small>

        </div>
    </form>
</div>

<?php include 'footer.php'; ?>