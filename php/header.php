<div id="barraSuperior" class="row">
    <div class="col-md-3">
        <img id="imagenLogo" src="images/coworking-logo.png" alt="Logo Congreso" />
    </div>
    <div class="col-md-6">
        <fieldset>
            <div id="cuadroSesion">
                <form class="form-inline formularioInicioSesion">
                    <div class="form-group">
                        <label class="sr-only" for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                    <button type="submit" class="btn btn-default">Enviar</button>
                </form>
                <!--<a href="#" >Registrate</a>-->
            </div>
        </fieldset>
    </div>
</div>

<div id="menuPrincipal">
    <?php
    ponerMenu($seccion, "inicio", "Inicio");
    ponerMenu($seccion, "salas", "Nuestras salas");
    ponerMenu($seccion, "empresas", "Empresas");
    ponerMenu($seccion, "eventos", "Eventos");
    ponerMenu($seccion, "contacto", "Contacto");
    ?>
</div>



<?php

function ponerMenu($seccion, $clave, $nombre) {
    if ($seccion == $clave) {
        echo '<a class="btn btn-default botonMenu active" href="?sec=' . $clave . '" role="button">' . $nombre . '</a>';
    } else {
        echo '<a class="btn btn-default botonMenu" href="?sec=' . $clave . '" role="button">' . $nombre . '</a>';
    }
}
