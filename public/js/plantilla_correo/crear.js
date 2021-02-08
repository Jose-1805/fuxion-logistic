$(function () {
    $('#btn-guardar-plantilla-correo').click(function () {
        guardarPlantillaCorreo();
    })
})

function guardarPlantillaCorreo() {
    var params = $("#form-crear-plantilla-correo").serialize();
    var url = $("#general_url").val()+"/plantilla-correo/guardar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            $("#form-crear-plantilla-correo")[0].reset();
            abrirAlerta("alertas-nueva-plantilla-correo","success",['La plantilla de correo ha sido registrada con éxito.'],null,'body');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nueva-plantilla-correo","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}