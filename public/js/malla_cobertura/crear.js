$(function () {
    $('#btn-guardar-malla-cobertura').click(function () {
        guardarMallaCobertura();
    });
})

function guardarMallaCobertura(){

    var params = new FormData(document.getElementById('form-crear-malla-cobertura'));
    var url = $("#general_url").val()+"/malla-cobertura/guardar";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
                $("#form-crear-malla-cobertura")[0].reset();
                abrirAlerta("alertas-malla-cobertura","success",['Malla de cobertura creada con éxito'],null,'body');
                cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-malla-cobertura","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}