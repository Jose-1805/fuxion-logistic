var id_select = null;
$(function () {
    $('body').on('click','.btn-eliminar-plantilla-correo',function () {
        id_select = $(this).data('plantilla-correo');
    })

    $('#btn-action-eliminar-plantilla-correo').click(function () {
        eliminarPlantillaCorreo();
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaPlantillasCorreos() {
    var tabla_bodegas = $('#tabla-plantillas-correos').dataTable({ "destroy": true });
    tabla_bodegas.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-plantillas-correos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_bodegas = $('#tabla-plantillas-correos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/plantilla-correo/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function eliminarPlantillaCorreo() {
    var paramams = {id:id_select,_token:$('#general_token').val()};
    var url = $('#general_url').val()+'/plantilla-correo/borrar';

    abrirBlockUiCargando('Eliminando ...');

    $.post(url,paramams)
        .done(function (data) {
            abrirAlerta("alertas-plantillas-correos","success",['Plantilla de correo eliminada con éxito'],null,'body');
            $('#row_'+id_select).remove();
            id_select = null;
            $('#modal-eliminar-plantilla-correo').modal('hide');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-plantillas-correos","danger",JSON.parse(jqXHR.responseText),null,'body');
            cerrarBlockUiCargando();
        })
}