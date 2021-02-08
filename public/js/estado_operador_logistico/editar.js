$(function () {
    $('#btn-editar-estado-operador-logistico').click(function () {
        editarEstadoOperadorLogistico();
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

function editarEstadoOperadorLogistico() {
    var params = $("#form-editar-estado-operador-logistico").serialize();
    var url = $("#general_url").val()+"/estado-operador-logistico/actualizar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            window.location.href = $('#general_url').val()+'/estado-operador-logistico';
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-editar-estado-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}