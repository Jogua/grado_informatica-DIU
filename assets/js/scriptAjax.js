function MostrarConsultaEventos() {
    var busqueda = $('#busqueda').val();
    var parametros = {
        search : busqueda
    };
    $.ajax({
            data:  parametros,
            url:   '../php/scripts/mostrarEventos.php',
            type:  'POST',
            success:  function (response) {
                    $("#todosEventos").html(response);
            }
    });
}
