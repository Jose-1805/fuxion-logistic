$(function () {
    $('#btn-guardar-usuario').click(function () {
        guardarUsuario();
    });
})

function guardarUsuario(){

    var params = new FormData(document.getElementById('form-crear-usuario'));
    var url = $("#general_url").val()+"/usuario/store";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
                $("#form-crear-usuario")[0].reset();
                abrirAlerta("alertas-nuevo-usuario","success",['Usuario creado con éxito'],null,'body');
                cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-nuevo-usuario","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}