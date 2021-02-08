$(function () {
    $('#btn-guardar-malla-cobertura').click(function () {
        guardarCorte();
    });
})

function guardarCorte(){

    var params = new FormData(document.getElementById('form-malla-cobertura'));
    var url = $("#general_url").val()+"/malla-cobertura/guardar-importacion";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
                $("#form-malla-cobertura")[0].reset();
                abrirAlerta("alertas-malla-cobertura","success",['Los datos de la malla de cobertura se importaron con éxito'],null,'body');
                cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-malla-cobertura","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}