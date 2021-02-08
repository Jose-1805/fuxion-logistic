var corte_eliminar = null;
$(function () {
    //cargarTablaCortes();
    $('body').on('click','.btn-eliminar-corte',function () {
        corte_eliminar = $(this).data('corte');
        $('#modal-eliimnar-corte').modal('show');
    })

    $('#btn-action-eliminar-corte').click(function () {
        $('#modal-eliimnar-corte').modal('hide');
        if(corte_eliminar){
            var params = {_token:$('#general_token').val(),corte:corte_eliminar};
            var url = $("#general_url").val()+"/corte/eliminar";

            abrirBlockUiCargando('Eliminando ');

            $.post(url,params)
                .done(function (data) {
                    corte_eliminar = null;
                    abrirAlerta("corte","success",['Corte eliminado con éxito.'],null,'body');
                    cerrarBlockUiCargando();
                    cargarTablaCortes();
                })
                .fail(function (jqXHR,state,error) {
                    abrirAlerta("corte","danger",JSON.parse(jqXHR.responseText),null,null);
                    cerrarBlockUiCargando();
                })
        }
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaCortes() {
    var tabla_cortes = $('#tabla-cortes').dataTable({ "destroy": true });
    tabla_cortes.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-cortes').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_cortes = $('#tabla-cortes').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/corte/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}