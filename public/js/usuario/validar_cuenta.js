$(function () {
    $('#btn-validar-cuenta').click(function () {
        validarCuenta();
    });
})


function validarCuenta(){

    var params = $("#form-validar-cuenta").serialize();
    var url = $("#general_url").val()+"/usuario/validar-cuenta";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                if(data.mensaje){
                    $('#form-validar-cuenta').parent().remove();
                    cerrarBlockUiCargando();
                    abrirAlerta("alertas-validacion-cuenta","success",[data.mensaje],null,'body');
                }else if(data.href){
                    window.location.href = data.href;
                }else {
                    window.location.href = $('#general_url').val();
                }
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-validacion-cuenta","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        })
}