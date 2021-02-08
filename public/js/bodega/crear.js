$(function () {
    $('#select-pais').change(function () {
        var pais = $(this).val();
        if(pais != ''){
            abrirBlockUiElemento($('#contenedor-select-departamentos'),'Cargando');
            var params = {
                _token:$('#general_token').val(),
                pais:pais,
                name:'select-departamento'
            }
            var url = $('#general_url').val()+'/tareas-sistema/select-departamentos';
            $.post(url,params)
                .done(function (data) {
                    $('#contenedor-select-departamentos').children('#select-departamento').remove();
                    $('#contenedor-select-departamentos').append(data);
                    cerrarBlockUiElemento($('#contenedor-select-departamentos'));
                })
        }
    })

    $('body').on('change','#select-departamento',function () {
        var departamento = $(this).val();
        if(departamento != ''){
            abrirBlockUiElemento($('#contenedor-select-ciudades'),'Cargando');
            var params = {
                _token:$('#general_token').val(),
                departamento:departamento,
                name:'ciudad'
            }
            var url = $('#general_url').val()+'/tareas-sistema/select-ciudades';
            $.post(url,params)
                .done(function (data) {
                    $('#contenedor-select-ciudades').children('#ciudad').remove();
                    $('#contenedor-select-ciudades').append(data);
                    cerrarBlockUiElemento($('#contenedor-select-ciudades'));
                })
        }
    })

    $('#btn-guardar').click(function () {
        guardarBodega()
    })
})

function guardarBodega() {
    var params = $("#form-crear-bodega").serialize();
    var url = $("#general_url").val()+"/bodega/guardar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            $("#form-crear-bodega")[0].reset();
            abrirAlerta("alertas-nueva-bodega","success",['La bodega ha sido registrada con éxito.'],null,'body');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nueva-bodega","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}