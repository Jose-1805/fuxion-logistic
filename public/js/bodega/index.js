$(function () {
    //cargarTablaCortes();
})

function setCols(columns) {
    cols = columns
}

function cargarTablaCortes() {
    var tabla_bodegas = $('#tabla-bodegas').dataTable({ "destroy": true });
    tabla_bodegas.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-bodegas').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_bodegas = $('#tabla-bodegas').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/bodega/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            if(tiene_opciones) {
                var opciones = $(nRow).children('td').eq(5).html();
                opciones = opciones.replace(/&lt;/g, '<');
                opciones = opciones.replace(/&gt;/g, '>');
                $(nRow).children('td').eq(5).html(opciones);
                $(nRow).attr('id', 'row_' + aData.id);
                setTimeout(function () {
                }, 300);
            }
        },
    });
}