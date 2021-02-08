$(function () {
    $('#btn-guardar-corte').click(function () {
        guardarCorte();
    });
})

function guardarCorte(){

    var params = new FormData(document.getElementById('form-corte-pedidos'));
    var url = $("#general_url").val()+"/corte/guardar";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
                $("#form-corte-pedidos")[0].reset();
                if(data.mensaje_info)
                    abrirAlerta("alertas-corte","success",[['El corte se ha almacenado con  éxito'],[data.mensaje_info]],null,'body');
                else
                    abrirAlerta("alertas-corte","success",['El corte se ha almacenado con  éxito'],null,'body');
                cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-corte","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}