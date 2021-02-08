var id_select = null;
$(function () {
    $('body').on('click','.btn-eliminar-estado-pedido',function () {
        id_select = $(this).data('estado-pedido');
    })

    $('#btn-action-eliminar-estado-pedido').click(function () {
        eliminarEstadoPedido();
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaEstadosPedidos() {
    var tabla_bodegas = $('#tabla-estados-pedidos').dataTable({ "destroy": true });
    tabla_bodegas.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-estados-pedidos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_bodegas = $('#tabla-estados-pedidos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/estado-pedido/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function eliminarEstadoPedido() {
    var paramams = {id:id_select,_token:$('#general_token').val()};
    var url = $('#general_url').val()+'/estado-pedido/borrar';

    abrirBlockUiCargando('Eliminando ...');

    $.post(url,paramams)
        .done(function (data) {
            abrirAlerta("alertas-estados-pedidos","success",['Estado de pedido eliminado con éxito'],null,'body');
            $('#row_'+id_select).remove();
            id_select = null;
            $('#modal-eliminar-estado-pedido').modal('hide');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-estados-pedidos","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        })
}