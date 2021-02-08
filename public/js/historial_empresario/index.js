var cols = null;
$(function () {
    $('body').on('change','.campo-filtro',function () {
        cargarTablaHistorialEmpresario();
    })

    $('#btn-exportar').click(function () {
        exportar();
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaHistorialEmpresario() {
    var tabla_historial_empresario = $('#tabla-historial-empresario').dataTable({ "destroy": true });
    tabla_historial_empresario.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-historial-empresario').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })
    $('#tabla-historial-empresario').on('preXhr.dt', function(e, settings, json) {
        json.fecha_inicio = $('#fecha_inicio').val();
        json.fecha_fin = $('#fecha_fin').val();
    })

    tabla_historial_empresario = $('#tabla-historial-empresario').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        columns: cols,
        ajax: $("#general_url").val()+"/historial-empresario/lista",
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function exportar() {
    var params = "?fecha_inicio="+$('#fecha_inicio').val()
        +"&fecha_fin="+$('#fecha_fin').val();

    var url = $('#general_url').val()+'/historial-empresario/exportar'+params;
    window.location.href = url;
}