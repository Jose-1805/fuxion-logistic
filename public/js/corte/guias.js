$(function () {
    $('.btn-descargar-guias-manuales').click(function () {
        var ol = $('#select-ol').val();
        if($('#corte').val()){
            window.location.href = $('#general_url').val()+'/corte/descarga-guias/'+$('#corte').val()+'/'+ol;
        }else{
            window.location.reload(true);
        }
    })

    $('#btn-guias-automaticas').click(function () {
        $('#modal-confirm-guias-automaticas').modal('show');
    });

    $('#btn-confirm-guas-automaticas').click(function () {
        $('#modal-confirm-guias-automaticas').modal('hide');
        guiasAutomaticas();
    })
});

function guiasAutomaticas() {
    var url = $('#general_url').val()+'/corte/guias-automaticas';
    var params = {_token:$('#general_token').val(),corte_id:$('#corte').val()};
    abrirBlockUiCargando('Procesando ');
    $.post(url,params)
    .done(function (data) {
        if(data.success) {
            if(data.redirect){
                window.location.href = data.redirect;
            }else {
                abrirAlerta("alertas-guias", "success", ['Guías automáticas procesadas con éxito. ' + data.guias_relacionadas + ' guías procesadas.'], null, 'body');
                cerrarBlockUiCargando();
            }
        }
    })
    .fail(function (jqXHR,state,error) {
        abrirAlerta("alertas-guias","danger",JSON.parse(jqXHR.responseText),null,null);
        cerrarBlockUiCargando();
    });
}

$(function () {
    $('.btn-informe-productos').click(function () {
        if($('#corte').val()){
            window.location.href = $('#general_url').val()+'/corte/informe-productos/'+$('#corte').val();
        }else{
            window.location.reload(true);
        }
    })

});