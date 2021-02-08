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

    $('#btn-editar').click(function () {
        editarBodega()
    })
})

function editarBodega() {
    var params = $("#form-editar-bodega").serialize();
    var url = $("#general_url").val()+"/bodega/actualizar";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            window.location.href = $('#general_url').val()+'/bodega';
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-editar-bodega","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}