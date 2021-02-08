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

    $('#btn-guardar-operador-logistico').click(function () {
        guardarOperadorLogistico();
    });
})

function guardarOperadorLogistico(){

    var params = new FormData(document.getElementById('form-crear-operador-logistico'));
    var url = $("#general_url").val()+"/operador-logistico/guardar";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
                $("#form-crear-operador-logistico")[0].reset();
                abrirAlerta("alertas-nuevo-operador-logistico","success",['Operador logístico creado con éxito'],null,'body');
                cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirAlerta("alertas-nuevo-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        }
    });
}