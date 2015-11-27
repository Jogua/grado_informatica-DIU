<?php

switch ($seccion) {
    case "salas":
    case "empresas":
    case "eventos":
    case "contacto":
    case "inicio":
        $direccion = './php/' . $seccion . '.php';
        break;
    default:
        $direccion = './php/inicio.php';
        break;
}

include $direccion;
