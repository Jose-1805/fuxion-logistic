$(function () {
    $('#btn-guardar-estado-pedido').click(function () {
        guardarEstadoPedido();
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

function guardarEstadoPedido() {
    var params = $("#form-crear-estado-pedido").serialize();
    var url = $("#general_url").val()+"/estado-pedido/guardar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            window.location.reload();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nuevo-estado-pedido","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}