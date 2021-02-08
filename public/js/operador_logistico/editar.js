$(function () {
    $('#btn-actualizar-operador-logistico').click(function () {
        actualizarOperadorLogistico();
    });
})

function actualizarOperadorLogistico(){

    var params = new FormData(document.getElementById('form-editar-operador-logistico'));
    var url = $("#general_url").val()+"/operador-logistico/actualizar";

    abrirBlockUiCargando('Guardando');
    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            abrirAlerta("alertas-editar-operador-logistico","success",['Operador logístico editado con éxito'],null,'body');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-editar-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}