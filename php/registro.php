<?php
$seccion = "";
include 'header.php';
?>

<div class="container">
    <h3>Regístrate</h3>
    <hr>
    <form class="form-signin" method="POST" id="formularioRegistroUsuario" name="formularioRegistroUsuario" action="" data-toggle="validator" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Carlos">
        </div>
        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Fernández">
        </div>
        <div class="form-group has-feedback">
            <label>Correo electrónico</label>
            <input type="email" pattern="^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$" class="form-control" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label>Contraseña</label>
            <input type="password" data-minlength="6" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label>Repetir contraseña</label>
            <input type="password" class="form-control" id="password2" name="password2" data-match="#password" placeholder="Repetir contraseña" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="612345678">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary derecha">Regístrate</button>
            <small class="izquierda">¿Estás registrado pero <a href="recordarContrasena.php">has olvidado tu contraseña</a>?</small>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>