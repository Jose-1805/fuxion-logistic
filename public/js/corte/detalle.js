var cols = [
    {data: 'orden_id', name: 'orden_id', "className": "text-center"},
    {data: 'fecha_orden', name: 'fecha_orden'},
    {data: 'fecha_impresion', name: 'fecha_impresion'},
    {data: 'serie', name: 'serie'},
    {data: 'correlativo', name: 'correlativo'},
    {data: 'impreso_por', name: 'impreso_por'},
    {data: 'empresario', name: 'empresario'}
];
$(function () {
    cargarTablaPedidosCorte();

    $('.btn-solicitar-guias').click(function () {
        solicitarGuias();
    })
})

function cargarTablaPedidosCorte() {
    var tabla_pedidos_corte = $('#tabla-pedidos-corte').dataTable({ "destroy": true });
    tabla_pedidos_corte.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-pedidos-corte').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_pedidos_corte = $('#tabla-pedidos-corte').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/corte/lista-pedidos-corte/"+$('#corte').val(),
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function solicitarGuias() {
    var params = {_token:$('#general_token').val()};
    var url = $("#general_url").val()+"/corte/aplicar-malla-cobertura/"+$('#corte').val();

    abrirBlockUiCargando('Aplicando malla de cobertura ');

    $.post(url,params)
        .done(function (data) {
            if(data.success){
                window.location.href = $('#general_url').val()+"/corte/guias/"+$('#corte').val();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-pedidos-corte","danger",JSON.parse(jqXHR.responseText),null,"body");
            cerrarBlockUiCargando();
        })
}