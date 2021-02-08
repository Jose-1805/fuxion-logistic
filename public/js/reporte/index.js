var reporte_seleccionado = '';
$(function () {
    $('body').on('change','.campo-filtro',function () {
        cargarTablaReportes();
    })

    $('#btn-exportar').click(function () {
        exportar();
    })
})

function cargarTablaReportes() {
    //el nombr del reporte equivale al id del div que contiene la tabla del reporte seleccionado
    //y el campo que identifica el reporte que debe enviar el servidor
    var reporte = $('#reporte').val();
    //se saca el id de la tabla
    var tabla = $('#'+reporte).find('table').eq(0).attr('id');

    if(reporte != reporte_seleccionado){
        $('.contenedor-tabla-reporte').addClass('hide');
        $('#'+reporte).removeClass('hide');
        reporte_seleccionado = reporte;
    }

    var tabla_reportes = $('#'+tabla).dataTable({ "destroy": true });
    tabla_reportes.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#'+tabla).on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })
    $('#'+tabla).on('preXhr.dt', function(e, settings, json) {
        json.reporte = $('#reporte').val();
        json.fecha_inicio = $('#fecha_inicio').val();
        json.fecha_fin = $('#fecha_fin').val();
    })

    tabla_reportes = $('#'+tabla).DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        columns: getCols(reporte),

        ajax: $("#general_url").val()+"/reporte/lista",
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

/**
 * Retorna las columnas dependiendo del reporte seleccionado
 */
function getCols(report) {
    if(report == 'logistica')
    {
        return [
            {data: 'fecha_orden', name: 'fecha_orden'},
            {data: 'factura', name: 'factura'},
            {data: 'orden_id', name: 'orden_id'},
            {data: 'empresario_id', name: 'empresario_id'},
			{data: 'numero_guia', name: 'numero_guia'},
            {data: 'fecha_proceso', name: 'fecha_proceso'},
            {data: 'fecha_envio', name: 'fecha_envio'},
            {data: 'fecha_entregado', name: 'fecha_entregado'},
            {data: 'fecha_devolucion', name: 'fecha_devolucion'},
            {data: 'nombre', name: 'nombre'},
            {data: 'ciudad', name: 'ciudad'},
            {data: 'departamento', name: 'departamento'},
            {data: 'estado', name: 'estado'},
            {data: 'descripcion', name: 'descripcion'},
        ];
    }else if(report == 'incidencias'){
        return [
            {data: 'fecha_orden', name: 'fecha_orden'},
            {data: 'factura', name: 'factura'},
            {data: 'orden_id', name: 'orden_id'},
            {data: 'empresario_id', name: 'empresario_id'},
			{data: 'numero_guia', name: 'numero_guia'},
            {data: 'fecha_novedad', name:'fecha_novedad'},
            {data: 'descripcion', name:'descripcion'},
        ];
    }else if(report == 'pedidos_productos'){
        return [
            {data: 'fecha_orden', name: 'fecha_orden'},
            {data: 'factura', name: 'factura'},
            {data: 'orden_id', name: 'orden_id'},
            {data: 'empresario_id', name: 'empresario_id'},
            {data: 'numero_corte', name:'numero_corte'},
            {data: 'codigo_producto', name:'codigo_producto'},
            {data: 'descripcion_producto', name:'descripcion_producto'},
            {data: 'cantidad', name:'cantidad'},
            {data: 'precio_unitario', name:'precio_unitario'},
            {data: 'precio_total', name:'precio_total'},
            {data: 'estado', name:'estado'},
            {data: 'razon_estado', name:'razon_estado'},
        ];
    }else if(report == 'tiempos_logistica'){
        return [
            {data: 'fecha_orden', name: 'fecha_orden'},
            {data: 'factura', name: 'factura'},
            {data: 'orden_id', name: 'orden_id'},
            {data: 'empresario_id', name: 'empresario_id'},
			{data: 'numero_guia', name: 'numero_guia'},
            {data: 'tiempo_salida_bodega', name: 'tiempo_salida_bodega'},
            {data: 'tiempo_entrega', name: 'tiempo_entrega'},
            {data: 'ciudad', name: 'ciudad'},
            {data: 'departamento', name: 'departamento'},
            {data: 'nombre', name: 'nombre'},
        ];
    }
}

function exportar() {
    var params = "?fecha_inicio="+$('#fecha_inicio').val()
        +"&fecha_fin="+$('#fecha_fin').val()
        +"&reporte="+$('#reporte').val();

    var url = $('#general_url').val()+'/reporte/exportar'+params;
    window.location.href = url;
}