function MostrarConsultaEventos() {
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

function enviarFormularioRegistro() {
    alert("Empieza");
    $.ajax({
        data: $('#formularioRegistroUsuario').serialize(), //codifica y manda los datos por el metodo seleccionado
        url: '../php/scripts/registro.php',
        type: 'POST',
        success: function (response) {
            alert("exito");
            $("#resultado").html(response);
        }

    });
}

//$('#formularioRegistroUsuario').on('submit', function (e) {
//    e.preventDefault(); //para que no se ejecute el action del formulario
//    alert("Empieza");
//    $.ajax({
//        data: $('#formularioRegistroUsuario').serialize(), //codifica y manda los datos por el metodo seleccionado
//        url: 'scripts/registro.php',
//        type: 'POST',
//        success: function (response) {
//            $("#alertas").html(response);
//        }
//
//    });
//    alert("Acaba");
//});

