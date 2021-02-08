$(function () {
    $('#btn-editar-plantilla-correo').click(function () {
        editarPlantillaCorreo();
    })
})

function editarPlantillaCorreo() {
    var params = $("#form-editar-plantilla-correo").serialize();
    var url = $("#general_url").val()+"/plantilla-correo/actualizar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            window.location.href = $('#general_url').val()+'/plantilla-correo';
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-editar-plantilla-correo","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}