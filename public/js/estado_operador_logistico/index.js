var id_select = null;
$(function () {
    $('body').on('click','.btn-eliminar-estado-operador-logistico',function () {
        id_select = $(this).data('estado-operador-logistico');
    })

    $('#btn-action-eliminar-estado-operador-logistico').click(function () {
        eliminarEstadoOperadorLogistico();
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaEstadosOperadoresLogisticos() {
    var tabla_bodegas = $('#tabla-estados-operadores-logisticos').dataTable({ "destroy": true });
    tabla_bodegas.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-estados-operadores-logisticos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_bodegas = $('#tabla-estados-operadores-logisticos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/estado-operador-logistico/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function eliminarEstadoOperadorLogistico() {
    var paramams = {id:id_select,_token:$('#general_token').val()};
    var url = $('#general_url').val()+'/estado-operador-logistico/borrar';

    abrirBlockUiCargando('Eliminando ...');

    $.post(url,paramams)
        .done(function (data) {
            abrirAlerta("alertas-estados-operadores-logisticos","success",['Estado de operador logístico eliminado con éxito'],null,'body');
            $('#row_'+id_select).remove();
            id_select = null;
            $('#modal-eliminar-estado-operador-logistico').modal('hide');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-estados-operadores-logisticos","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        })
}