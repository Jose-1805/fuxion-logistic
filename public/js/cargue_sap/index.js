var cols = null;
var pedido = null;
$(function () {
    $('body').on('click','.btn-cargar',function () {
        pedido = $(this).data('pedido');
        $('#modal-confirmar-cargue').modal('show');
    })

    $('#btn-action-cargue').click(function () {
        if(pedido) {
            $('#modal-confirmar-cargue').modal('hide');
            var params = {_token:$('#general_token').val(),pedido:pedido};
            var url = $("#general_url").val() + "/cargue-sap/cargar";

            abrirBlockUiCargando('Cargando a SAP ');

            $.post(url, params)
                .done(function (data) {
                    abrirAlerta("alertas-cargue-sap", "success", ['Pedido cargado a SAP con éxito.'], null, 'body');
                    cerrarBlockUiCargando();
                    cargarTablaPedidos();
                })
                .fail(function (jqXHR, state, error) {
                    abrirAlerta("alertas-cargue-sap", "danger", JSON.parse(jqXHR.responseText), null, null);
                    cerrarBlockUiCargando();
                })
        }
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaPedidos() {
    var tabla_pedidos = $('#tabla-pedidos').dataTable({ "destroy": true });
    tabla_pedidos.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-pedidos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_pedidos = $('#tabla-pedidos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/cargue-sap/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}