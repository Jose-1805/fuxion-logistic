$(function () {
    $('#btn-actualizar-malla-cobertura').click(function () {
        actualizarMallaCobertura();
    });
})

function actualizarMallaCobertura(){

    var params = new FormData(document.getElementById('form-editar-malla-cobertura'));
    var url = $("#general_url").val()+"/malla-cobertura/actualizar";

    abrirBlockUiCargando('Guardando');
    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            abrirAlerta("alertas-editar-malla-cobertura","success",['Malla de cobertura editada con éxito'],null,'body');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-editar-malla-cobertura","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}