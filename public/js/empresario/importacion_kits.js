$(function () {
    $('#btn-guardar-kits-empresarios').click(function () {
        guardarKitsEmpresarios();
    });
})

function guardarKitsEmpresarios(){
    var params = new FormData(document.getElementById('form-kits-empresarios'));
    var url = $("#general_url").val()+"/empresario/importar-kits";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $("#form-kits-empresarios")[0].reset();
            abrirAlerta("alertas-kits-empresarios","success",['La lista de kits de empresarios ha sido importada con éxito'],null,'body');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-kits-empresarios","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}