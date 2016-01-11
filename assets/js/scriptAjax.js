function mostrarConsultaEventos() {
    var busqueda = $('#busqueda').val();
    var parametros = {
        search: busqueda
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/mostrarEventos.php',
        type: 'POST',
        success: function (response) {
            $("#todosEventos").html(response);
        }
    });
}

function enviarFormularioInicioSesion() {
    $.ajax({
        data: $("#formularioInicioSesion").serialize(), //codifica y manda los datos por el metodo seleccionado
        url: '../php/scripts/login.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function enviarFormularioRegistro() {
    $.ajax({
        data: $('#formularioRegistroUsuario').serialize(),
        url: '../php/scripts/registro.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function altaSala(id) {
    var parametros = {
        idSala: id,
        value: 1
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/cambiarEstadoSala.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function bajaSala(id) {
    var parametros = {
        idSala: id,
        value: 0
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/cambiarEstadoSala.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function filtroReservarSala() {
    var name = $('#nombreSala').val();
    var cap = $('#capacidadSala').val();
    var fini = $('#fechaInicioSala').val();
    var ffin = $('#fechaFinSala').val();
    var parametros = {
        nombre: name,
        capacidad: cap,
        fechaInicio: fini,
        fechaFin: ffin
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/filtrarSala.php',
        type: 'POST',
        success: function (response) {
            $("#salas").html(response);
        }
    });
}

function reservarSala(id) {
    var idEmpresa = $('#idEmpresa').val();
    var fini = $('#fechaInicioSala').val();
    var ffin = $('#fechaFinSala').val();
    var parametros = {
        idSala: id,
        idEmpresa: idEmpresa,
        fechaInicio: fini,
        fechaFin: ffin
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/reservarSala.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function cancelarReserva(id) {
    var parametros = {
        idReserva: id
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/cancelarReserva.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function apuntarseEvento(id) {
    var parametros = {
        id: id
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/apuntarseEvento.php',
        type: 'GET',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function desapuntarseEvento(id) {
    var parametros = {
        id: id
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/desapuntarseEvento.php',
        type: 'GET',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function modificarMisDatos(formulario) {

    var parametros = {
        idUsuario: formulario.idUsuario.value,
        nombre: formulario.nombre.value,
        apellidos: formulario.apellidos.value,
        correo: formulario.correo.value,
        pass: formulario.pass.value,
        telefono: formulario.telefono.value
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/modificarMisDatos.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function altaEvento(id) {
    var parametros = {
        idEvento: id
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/altaEvento.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

function cancelarEvento(id) {
    var parametros = {
        idEvento: id
    };
    $.ajax({
        data: parametros,
        url: '../php/scripts/cancelarEvento.php',
        type: 'POST',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

$(document).ready(function () {
    $('#formularioModificarSala').ajaxForm(function (response) {
        $("#resultado").html(response);
    });
    $('#formularioAnadirSala').ajaxForm(function (response) {
        $("#resultado").html(response);
    });
    $('#formularioAltaEmpresa').ajaxForm(function (response) {
        $("#resultado").html(response);
    });
        $('#formularioCrearEvento').ajaxForm(function (response) {
        $("#resultado").html(response);
    });
}); 