$(function () {
    $('.btn-subir-guias').click(function () {
        var ol = $(this).data('ol');
        var params = new FormData(document.getElementById('form-guias-'+ol));
        var url = $("#general_url").val()+"/corte/procesar-guias-manuales";

        abrirBlockUiCargando('Guardando ');

        $.ajax({
            url: url,
            data: params,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                if(data.success) {
                    if(data.redirect){
                        window.location.href = data.redirect;
                    }else {
                        $('#form-guias-' + ol)[0].reset();
                        abrirAlerta("alertas-guias-manuales", "success", ['Archivo procesado con éxito. ' + data.guias_relacionadas + ' guías procesadas.'], null, 'body');
                        cerrarBlockUiCargando();
                    }
                }
            },
            error: function (jqXHR, error, state) {
                abrirAlerta("alertas-guias-manuales","danger",JSON.parse(jqXHR.responseText),null,'body');
                cerrarBlockUiCargando();
            }
        });
    })
})