<?php

include_once 'phpmailer/class.phpmailer.php';
include_once 'phpmailer/class.smtp.php';
include_once 'enviar_mail.php';
include_once '../libs/myLib.php';

if (!empty($_POST['inputNombre']) && !empty($_POST['inputCorreo']) && !empty($_POST['inputConsulta'])) {
    $nombre = $_POST['inputNombre'];
    $correo = $_POST['inputCorreo'];
    $consulta = $_POST['inputConsulta'];

    if (enviarMail($correo, 'Petición de contacto', $consulta)) {
        salir('Se ha mandado el correo correctamente.', $_SERVER['HTTP_REFERER']);
    } else {
        salir('ERROR: No se ha mandando el correo.', $_SERVER['HTTP_REFERER']);
    }
    
} else {
    salir('ERROR: No se ha mandando el correo.', $_SERVER['HTTP_REFERER']);
}
?>
