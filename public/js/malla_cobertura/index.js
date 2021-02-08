var cols = [];
var id_select = null;
$(function () {
    $('body').on('click','.btn-eliminar-malla-cobertura',function () {
        id_select = $(this).data('malla-cobertura');
    })

    $('#btn-action-eliminar-malla-cobertura').click(function () {
        eliminarMallaCobertura();
    })
})

function setCols(columns){
    this.cols = columns;
}

function cargarTablaMallasCobertura(){
    var tabla_mallas_cobertura = $('#tabla-mallas-cobertura').dataTable({ "destroy": true });
    tabla_mallas_cobertura.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-mallas-cobertura').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_mallas_cobertura = $('#tabla-mallas-cobertura').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/malla-cobertura/lista",
        columns: this.cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function eliminarMallaCobertura() {
    var paramams = {id:id_select,_token:$('#general_token').val()};
    var url = $('#general_url').val()+'/malla-cobertura/borrar';

    abrirBlockUiCargando('Eliminando ...');

    $.post(url,paramams)
    .done(function (data) {
        abrirAlerta("alertas-malla-cobertura","success",['Malla cobertura eliminada con éxito'],null,'body');
        $('#row_'+id_select).remove();
        id_select = null;
        $('#modal-eliminar-malla-cobertura').modal('hide');
        cerrarBlockUiCargando();
    })
    .fail(function (jqXHR,state,error) {
        abrirAlerta("alertas-malla-cobertura","danger",JSON.parse(jqXHR.responseText),null,'body');
        cerrarBlockUiCargando();
    })
}