$(function () {
    $('#btn-password-empresario').click(function () {
        passwordEmpresario();
    });
})


function passwordEmpresario(){

    var params = $("#form-password-empresario").serialize();
    var url = $("#general_url").val()+"/usuario/password-empresario";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                if(data.mensaje){
                    $('#form-password-empresario').parent().remove();
                    cerrarBlockUiCargando();
                    abrirAlerta("alertas-password-empresario","success",[data.mensaje],null,'body');
                }else if(data.href){
                    window.location.href = data.href;
                }else {
                    window.location.href = $('#general_url').val();
                }
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-password-empresario","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        })
}