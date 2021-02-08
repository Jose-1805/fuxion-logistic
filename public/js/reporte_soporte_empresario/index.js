var reporte_seleccionado = '';
$(function () {
    $('body').on('change','.campo-filtro',function () {
        cargarTablaReporteSoporteEmpresario();
    })

    $('#btn-exportar').click(function () {
        exportar();
    })
})

function cargarTablaReporteSoporteEmpresario() {

    var tabla_reporte_soporte_empresario = $('#tabla-reporte-soporte-emopresario').dataTable({ "destroy": true });
    tabla_reporte_soporte_empresario.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-reporte-soporte-emopresario').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })
    $('#tabla-reporte-soporte-emopresario').on('preXhr.dt', function(e, settings, json) {
        json.fecha_inicio = $('#fecha_inicio').val();
        json.fecha_fin = $('#fecha_fin').val();
    })

    tabla_reporte_soporte_empresario = $('#tabla-reporte-soporte-emopresario').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        columns: [
            {data: 'fecha', name: 'fecha'},
            {data: 'orden', name: 'orden'},
            {data: 'accion', name: 'accion'},
            {data: 'no_factura', name: 'no_factura'},
            {data: 'usuario', name: 'usuario'}
        ],

        ajax: $("#general_url").val()+"/reporte-soporte-empresario/lista",
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}


function exportar() {
    var params = "?fecha_inicio="+$('#fecha_inicio').val()
        +"&fecha_fin="+$('#fecha_fin').val();

    var url = $('#general_url').val()+'/reporte-soporte-empresario/exportar'+params;
    window.location.href = url;
}