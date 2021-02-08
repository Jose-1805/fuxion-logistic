$(function () {
    $('#btn-editar-estado-pedido').click(function () {
        editarEstadoPedido();
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

function editarEstadoPedido() {
    var params = $("#form-editar-estado-pedido").serialize();
    var url = $("#general_url").val()+"/estado-pedido/actualizar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            window.location.href = $('#general_url').val()+'/estado-pedido';
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-editar-estado-pedido","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}