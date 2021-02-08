var cols = [];
var id_select = null;
$(function () {
    $('body').on('click','.btn-eliminar-operador-logistico',function () {
        id_select = $(this).data('operador-logistico');
    })

    $('#btn-action-eliminar-operador-logistico').click(function () {
        eliminarOperadorLogistico();
    })
})

function setCols(columns){
    this.cols = columns;
}

function cargarTablaOperadoresLogisticos(){
    var tabla_operadore_logisticos = $('#tabla-operadores-logisticos').dataTable({ "destroy": true });
    tabla_operadore_logisticos.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-operadores-logisticos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_operadore_logisticos = $('#tabla-operadores-logisticos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/operador-logistico/lista",
        columns: this.cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function eliminarOperadorLogistico() {
    var paramams = {id:id_select,_token:$('#general_token').val()};
    var url = $('#general_url').val()+'/operador-logistico/borrar';

    abrirBlockUiCargando('Eliminando ...');

    $.post(url,paramams)
    .done(function (data) {
        abrirAlerta("alertas-operador-logistico","success",['Operador logístico eliminado con éxito'],null,'body');
        $('#row_'+id_select).remove();
        id_select = null;
        $('#modal-eliminar-operador-logistico').modal('hide');
        cerrarBlockUiCargando();
    })
    .fail(function (jqXHR,state,error) {
        abrirAlerta("alertas-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,'body');
        cerrarBlockUiCargando();
    })
}