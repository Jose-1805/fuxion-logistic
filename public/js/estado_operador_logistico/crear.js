$(function () {
    $('#btn-guardar-estado-operador-logistico').click(function () {
        guardarEstadoOperadorLogistico();
    })

    $('#notificacion_correo').change(function () {
        if($(this).prop('checked')) {
            $('#plantilla_correo').prop('disabled', false);
            $('#correos_destinatarios').prop('disabled', false);
        }else {
            $('#plantilla_correo').prop('disabled', true);
            $('#correos_destinatarios').prop('disabled', true);
        }
    })
})

function guardarEstadoOperadorLogistico() {
    var params = $("#form-crear-estado-operador-logistico").serialize();
    var url = $("#general_url").val()+"/estado-operador-logistico/guardar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            $("#form-crear-estado-operador-logistico")[0].reset();
            abrirAlerta("alertas-nuevo-estado-operador-logistico","success",['El estado de operador logístico ha sido registrado con éxito.'],null,'body');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nuevo-estado-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}